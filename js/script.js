const sr= ScrollReveal ({
    distance: '65px',
    duration: 2600,
    delay: 450,
    reset: true
});

sr.reveal('.logo',{delay:250,origin:'left'});
sr.reveal('.navbar',{delay:150,origin:'left'});
sr.reveal('.dobi-text',{delay:200,origin:'bottom'});
sr.reveal('.dobi-img',{delay:450,origin:'top'});

let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin.php';
};