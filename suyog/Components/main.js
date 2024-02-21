var navLinks = document.querySelectorAll('.navbar-expand-lg .navbar-nav .nav-link');
window.addEventListener('scroll', function () {
    let sc = scrollY;
    // navLinks.forEach(function (link) {
    //     link.style.color = 'black';
    // });
    if (sc > 50) {
        document.querySelector('header').style.backgroundColor = 'white'

        navLinks.forEach(function (link) {
            link.style.color = 'black';
        });
    }
    else{
        document.querySelector('header').style.backgroundColor = 'transparent'
        navLinks.forEach(function (link) {
            link.style.color = 'white';
        })
    };
})
document.querySelector('.reg').addEventListener('click', showreg)
document.querySelector('.sign-in').addEventListener('click', showlog)
function showlog() {

    event.preventDefault();
    document.querySelector('.login').style.display= 'block';
    document.querySelector('.register').style.display = 'none';
    if( document.querySelector('.login').style.display=='block'){
        document.body.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
        document.querySelector('.firstview').style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    }
}
function showreg() {
    event.preventDefault();

    document.querySelector('.login').style.display= 'none';
    document.querySelector('.register').style.display = 'block';
    document.body.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    document.querySelector('.firstview').style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    // return false;
}



document.querySelector('.lcr').addEventListener('click', lhide);
document.querySelector('.rcr').addEventListener('click', rhide);

function lhide() {
    event.preventDefault();
    document.body.style.backgroundColor = '';
    document.querySelector('.login').style.display= 'none';
    // return false;

}
function rhide() {
    event.preventDefault();
    document.querySelector('.register').style.display= 'none';
    document.body.style.backgroundColor = '';
    // return false;

}

function CheckPassword(password) {
    const pass_rgex =
      "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$";
  
    if (password.value.match(pass_rgex)) {
      return true;
    }   
     else {
      document.querySelector(".perror").innerHTML =
        " * Password must contain:<br> Minimum 8 characters<br> 1 uppercase<br> 1 lowercase<br> 1 number <br> 1special character.";
        return false;
    }
}

