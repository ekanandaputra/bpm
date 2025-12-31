document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.pw-toggle').forEach(function(btn){
    btn.addEventListener('click', function(){
      var input = this.parentElement.querySelector('input');
      if(!input) return;
      if(input.type === 'password'){
        input.type = 'text';
        this.textContent = '🙈';
      } else {
        input.type = 'password';
        this.textContent = '👁️';
      }
    });
  });
});

// mark active nav link by URL
document.addEventListener('DOMContentLoaded', function(){
  try{
    var path = window.location.pathname;
    document.querySelectorAll('.nav-item').forEach(function(a){
      if(a.getAttribute('href') === path){
        a.classList.add('active');
      }
    });
  }catch(e){}
});

