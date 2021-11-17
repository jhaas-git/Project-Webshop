// Mobile menu
var mobileMenu = document.getElementById('mobile-menu');
var overlay = document.getElementById('menu');
mobileMenu.addEventListener('click', function(){
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
    document.body.classList.toggle('lock-scroll');
});

// Displaying either the sign in or sign up form is processed through tabs.
function openForm(evt, formName) {
    var i, formTab, tablink;
    formTab = document.getElementsByClassName("formTab");
    for (i = 0; i < formTab.length; i++) {
      formTab[i].style.display = "none";
    }

    tablink = document.getElementsByClassName("tablink");
    for (i = 0; i < tablink.length; i++) {
      tablink[i].className = tablink[i].className.replace(" active", "");
    }
    document.getElementById(formName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  //  defaultOpen is added to sign in.
  document.getElementById("defaultOpen").click();