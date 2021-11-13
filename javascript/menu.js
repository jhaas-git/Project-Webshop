var mobileMenu = document.getElementById('mobile-menu');
var overlay = document.getElementById('menu');
mobileMenu.addEventListener('click', function(){
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
    document.body.classList.toggle('lock-scroll');
});