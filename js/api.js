(function(){
  var TOKEN='';
  fetch('api/csrf.php').then(function(r){return r.json();}).then(function(d){TOKEN=d.token||'';
    document.querySelectorAll('form[data-api]').forEach(function(f){
      var i=f.querySelector('[name=csrf_token]');
      if(!i){i=document.createElement('input');i.type='hidden';i.name='csrf_token';f.appendChild(i);}
      i.value=TOKEN;
    });
  });
})();
/* Overhill Junior School - AJAX layer (vanilla JS) */
(function(){
  function csrf(){
    var m=document.cookie.match(/(?:^|;\s*)ojs_csrf=([^;]+)/);
    return m?decodeURIComponent(m[1]):'';
  }
  // Generic AJAX form handler: <form data-api="api/contact.php" data-success="msg">
  document.querySelectorAll('form[data-api]').forEach(function(form){
    form.addEventListener('submit', function(ev){
      ev.preventDefault();
      var url=form.getAttribute('data-api');
      var note=form.querySelector('.form-feedback');
      if(!note){note=document.createElement('p');note.className='form-feedback';form.appendChild(note);}
      note.textContent='Sending...'; note.className='form-feedback';
      var fd=new FormData(form);
      fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-Token':form.querySelector('[name=csrf_token]')?form.querySelector('[name=csrf_token]').value:''}})
        .then(function(r){return r.json();})
        .then(function(res){
          if(res.ok){ note.textContent=res.message||'Submitted successfully.'; note.className='form-feedback ok'; form.reset(); }
          else { note.textContent=res.error||'Something went wrong.'; note.className='form-feedback err'; }
        })
        .catch(function(){ note.textContent='Network error. Please try again.'; note.className='form-feedback err'; });
    });
  });

  // Dynamic loaders by container data-load
  function get(url){return fetch(url).then(function(r){return r.json();});}
  var newsBox=document.getElementById('newsList');
  if(newsBox){
    var render=function(q,page){
      get('api/news.php?'+(q?'search='+encodeURIComponent(q)+'&':'')+'page='+(page||1)).then(function(res){
        if(!res.ok)return; newsBox.innerHTML='';
        if(!res.items.length){newsBox.innerHTML='<p>No news articles found.</p>';return;}
        res.items.forEach(function(n){
          var img=n.image?'<img src="'+n.image+'" alt="">':'';
          newsBox.insertAdjacentHTML('beforeend','<article class="news-card">'+img+'<h3>'+n.title+'</h3><p>'+(n.excerpt||'')+'</p></article>');
        });
      });
    };
    var sb=document.getElementById('newsSearch');
    if(sb)sb.addEventListener('input',function(){render(sb.value,1);});
    render('',1);
  }
  var evBox=document.getElementById('eventsList');
  if(evBox){get('api/events.php').then(function(res){if(!res.ok)return;evBox.innerHTML=res.items.length?'':'<p>No upcoming events.</p>';res.items.forEach(function(e){evBox.insertAdjacentHTML('beforeend','<article class="event-card"><div class="event-date">'+e.event_date+'</div><h3>'+e.title+'</h3><p>'+(e.description||'')+'</p></article>');});});}
  var stBox=document.getElementById('staffList');
  if(stBox){get('api/staff.php').then(function(res){if(!res.ok)return;res.items.forEach(function(s){var img=s.photo?s.photo:'images/staff.jpg';stBox.insertAdjacentHTML('beforeend','<div class="staff-card"><img src="'+img+'" alt=""><h4>'+s.name+'</h4><p>'+s.position+'</p></div>');});});}
  var faqBox=document.getElementById('faqList');
  if(faqBox){get('api/faqs.php').then(function(res){if(!res.ok)return;res.items.forEach(function(f){faqBox.insertAdjacentHTML('beforeend','<details class="faq-item"><summary>'+f.question+'</summary><p>'+f.answer+'</p></details>');});});}
  var dlBox=document.getElementById('downloadsList');
  if(dlBox){get('api/downloads.php').then(function(res){if(!res.ok)return;res.items.forEach(function(d){dlBox.insertAdjacentHTML('beforeend','<a class="download-row" href="'+d.file+'" download>'+d.title+' <span>'+(d.category||'')+'</span></a>');});});}
})();
