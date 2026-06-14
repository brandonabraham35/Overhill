(function(){
  var TOKEN='';
  fetch('api/csrf.php').then(function(r){return r.json();}).then(function(d){TOKEN=d.token||'';
    document.querySelectorAll('form[data-api]').forEach(function(f){
      var i=f.querySelector('[name=csrf_token]');
      if(!i){
        i=document.createElement('input');
        i.type='hidden';
        i.name='csrf_token';
        f.appendChild(i);
      }
      i.value=TOKEN;
    });
  });

  // Fetch settings and stats
  Promise.all([
    fetch('api/settings.php').then(function(r){ return r.json(); }),
    fetch('api/stats.php').then(function(r){ return r.json(); })
  ]).then(function(results) {
    var settingsRes = results[0];
    var statsRes = results[1];
    var combinedData = {};
    if (settingsRes.ok) {
      for (var k in settingsRes.settings) combinedData[k] = settingsRes.settings[k];
    }
    if (statsRes.ok) {
      for (var sk in statsRes.stats) combinedData[sk] = statsRes.stats[sk];
    }
    if (Object.keys(combinedData).length > 0) {
       walkAndReplace(document.body, combinedData);
    }
  });

  function walkAndReplace(node, data) {
    if (node.nodeType === 3) { // Text node
      var text = node.nodeValue;
      for (var key in data) {
        var regex = new RegExp('{{' + key + '}}', 'g');
        text = text.replace(regex, data[key]);
      }
      node.nodeValue = text;
    } else if (node.nodeType === 1 && node.nodeName !== 'SCRIPT' && node.nodeName !== 'STYLE') {
      var children = node.childNodes;
      for (var i = 0; i < children.length; i++) {
        walkAndReplace(children[i], data);
      }
    }
  }

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
          var img=n.image?'<div class="news-img" style="background-image:url(\''+n.image+'\')"></div>':'';
          var date = new Date(n.published_at);
          var day = date.getDate();
          var month = date.toLocaleString('default', { month: 'short' });
          newsBox.insertAdjacentHTML('beforeend',
            '<article class="news-card">' +
            '<div class="news-date"><span class="d">'+day+'</span><span class="m">'+month+'</span></div>' +
            '<div class="news-body"><h3>'+n.title+'</h3><p>'+(n.excerpt||'')+'</p><a href="school-news.php?slug='+n.slug+'">Read more &rarr;</a></div>' +
            '</article>'
          );
        });
      });
    };
    var sb=document.getElementById('newsSearch');
    if(sb)sb.addEventListener('input',function(){render(sb.value,1);});
    render('',1);
  }

  var evBox=document.getElementById('eventsList');
  if(evBox){
    get('api/events.php').then(function(res){
      if(!res.ok)return; evBox.innerHTML=res.items.length?'':'<p>No upcoming events.</p>';
      res.items.forEach(function(e){
        var date = new Date(e.event_date);
        var day = date.getDate();
        var month = date.toLocaleString('default', { month: 'short' });
        evBox.insertAdjacentHTML('beforeend',
          '<article class="news-card">' +
          '<div class="news-date"><span class="d">'+day+'</span><span class="m">'+month+'</span></div>' +
          '<div class="news-body"><h3>'+e.title+'</h3><p>'+(e.description||'')+'</p></div>' +
          '</article>'
        );
      });
    });
  }

  var stBox=document.getElementById('staffList');
  if(stBox){
    get('api/staff.php').then(function(res){
      if(!res.ok)return; stBox.innerHTML='';
      res.items.forEach(function(s){
        var img=s.photo?s.photo:'images/staff.jpg';
        stBox.insertAdjacentHTML('beforeend',
          '<div class="staff-card"><img src="'+img+'" alt=""><h4>'+s.name+'</h4><p>'+s.position+'</p></div>'
        );
      });
    });
  }

  var ldBox=document.getElementById('leadershipList');
  if(ldBox){
    get('api/leadership.php').then(function(res){
      if(!res.ok)return; ldBox.innerHTML='';
      res.items.forEach(function(l){
        var img=l.photo?l.photo:'images/staff.jpg';
        ldBox.insertAdjacentHTML('beforeend',
          '<div class="person-card"><div class="person-img" style="background-image:url(\''+img+'\')"></div>' +
          '<div class="person-body"><h3>'+l.name+'</h3><span class="person-role">'+l.title+'</span><p>'+(l.message||'')+'</p></div></div>'
        );
      });
    });
  }

  var faqBox=document.getElementById('faqList');
  if(faqBox){
    get('api/faqs.php').then(function(res){
      if(!res.ok)return; faqBox.innerHTML='';
      res.items.forEach(function(f){
        faqBox.insertAdjacentHTML('beforeend','<details class="faq-item"><summary>'+f.question+'</summary><p>'+f.answer+'</p></details>');
      });
    });
  }

  var dlBox=document.getElementById('downloadsList');
  if(dlBox){
    get('api/downloads.php').then(function(res){
      if(!res.ok)return; dlBox.innerHTML='';
      res.items.forEach(function(d){
        dlBox.insertAdjacentHTML('beforeend','<a class="download-row" href="'+d.file+'" download>'+d.title+' <span>'+(d.category||'')+'</span></a>');
      });
    });
  }

  var heroBox=document.getElementById('heroSlider');
  if(heroBox){
    get('api/hero.php').then(function(res){
      if(!res.ok || !res.items.length) return;
      var slidesContainer = heroBox; // In index.php it is the section itself
      var slidesHTML = '';
      var dotsHTML = '';
      res.items.forEach(function(s, i){
        var active = i === 0 ? ' active' : '';
        slidesHTML += '<div class="slide'+active+'" style="background-image:url(\''+s.image+'\')">' +
          '<div class="slide-overlay"></div>' +
          '<div class="container slide-content">' +
          '<span class="slide-kicker">Knowledge Is Power</span>' +
          '<h1>'+s.heading+'</h1>' +
          '<p>'+s.subheading+'</p>' +
          '<div class="slide-actions">' +
          '<a href="'+(s.button_link||'#')+'" class="btn btn-primary">'+(s.button_text||'Learn More')+'</a>' +
          '</div></div></div>';
        dotsHTML += '<button class="dot'+active+'" data-slide="'+i+'"></button>';
      });
      // Append arrows and dots
      slidesHTML += '<button class="slider-arrow prev" id="prevSlide" aria-label="Previous">&#10094;</button>' +
                    '<button class="slider-arrow next" id="nextSlide" aria-label="Next">&#10095;</button>' +
                    '<div class="slider-dots">'+dotsHTML+'</div>';
      heroBox.innerHTML = slidesHTML;
      // Re-initialize slider logic from main.js if needed, or implement here
      initSlider(heroBox);
    });
  }

  function initSlider(slider) {
    var slides = slider.querySelectorAll('.slide');
    var dots = slider.querySelectorAll('.dot');
    var idx = 0, timer;
    var go = function (n) {
      slides[idx].classList.remove('active');
      if (dots[idx]) dots[idx].classList.remove('active');
      idx = (n + slides.length) % slides.length;
      slides[idx].classList.add('active');
      if (dots[idx]) dots[idx].classList.add('active');
    };
    var next = function () { go(idx + 1); };
    var prev = function () { go(idx - 1); };
    var start = function () { timer = setInterval(next, 6000); };
    var reset = function () { clearInterval(timer); start(); };

    var nb = slider.querySelector('#nextSlide');
    var pb = slider.querySelector('#prevSlide');
    if (nb) nb.addEventListener('click', function () { next(); reset(); });
    if (pb) pb.addEventListener('click', function () { prev(); reset(); });
    dots.forEach(function (d) {
      d.addEventListener('click', function () { go(parseInt(d.dataset.slide, 10)); reset(); });
    });
    start();
  }

  var annBox=document.getElementById('announcementsList');
  if(annBox){
    get('api/announcements.php').then(function(res){
      if(!res.ok)return; annBox.innerHTML=res.items.length?'':'<p>No announcements.</p>';
      res.items.forEach(function(a){
        var date = new Date(a.created_at).toLocaleDateString();
        annBox.insertAdjacentHTML('beforeend', '<li><span class="announce-date">'+date+'</span><div><strong>'+a.title+'</strong><p>'+a.body+'</p></div></li>');
      });
    });
  }

  var galBox=document.getElementById('galleryContainer');
  if(galBox){
    var params = new URLSearchParams(window.location.search);
    var album = params.get('album');
    if(album){
      get('api/gallery.php?album='+encodeURIComponent(album)).then(function(res){
        if(!res.ok) { galBox.innerHTML='<p>Album not found.</p>'; return; }
        var h = '<div class="section-head"><h2>'+res.album.title+'</h2><p>'+(res.album.description||'')+'</p></div>';
        h += '<div class="gallery-grid">';
        res.images.forEach(function(img){
          h += '<div class="gallery-item"><a href="'+img.image+'" target="_blank"><img src="'+img.image+'" alt="'+(img.caption||'')+'"></a>'+(img.caption?'<p>'+img.caption+'</p>':'')+'</div>';
        });
        h += '</div><div class="center" style="margin-top:40px"><a href="gallery.php" class="btn btn-outline">&larr; Back to Albums</a></div>';
        galBox.innerHTML = h;
      });
    } else {
      get('api/gallery.php').then(function(res){
        if(!res.ok) return;
        if(!res.items.length){ galBox.innerHTML='<p>No albums found yet.</p>'; return; }
        var h = '<div class="prog-grid">';
        res.items.forEach(function(al){
          var img = al.cover_image || 'images/facility.jpg';
          h += '<a class="prog-card" href="gallery.php?album='+al.slug+'">' +
               '<div class="prog-img" style="background-image:url(\''+img+'\')"></div>' +
               '<div class="prog-body"><h3>'+al.title+'</h3><p>'+al.image_count+' Photos</p><span class="arrow">View Album &rarr;</span></div></a>';
        });
        h += '</div>';
        galBox.innerHTML = h;
      });
    }
  }

})();
