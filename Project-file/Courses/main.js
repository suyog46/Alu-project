var b1 = document.querySelector('.b1');
var b2 = document.querySelector('.b2');
var b3 = document.querySelector('.b3');
var t1 = document.querySelector('.t1'); 
var t2 = document.querySelector('.t2'); 
var t3 = document.querySelector('.t3'); 

b1.addEventListener('click', () => {
    b1.classList.add('btn-outline-danger')
    b3.classList.remove('btn-outline-danger')
    b2.classList.remove('btn-outline-danger')
    t1.style.display = 'block';
    t2.style.display = 'none';
    t3.style.display = 'none';
});

b2.addEventListener('click', () => {
    b2.classList.add('btn-outline-danger')
    b1.classList.remove('btn-outline-danger')
    b3.classList.remove('btn-outline-danger')

    t2.style.display = 'block';
    t1.style.display = 'none';
    t3.style.display = 'none';
});

b3.addEventListener('click', () => {
    b3.classList.add('btn-outline-danger')
    b1.classList.remove('btn-outline-danger')
    b2.classList.remove('btn-outline-danger')
    t3.style.display = 'block';
    t1.style.display = 'none';
    t2.style.display = 'none';
});
// function dis(){
//     document.querySelector('.pre').style.display = "block";
//     document.querySelector('.ad').classList.add('bl');
// }
    
