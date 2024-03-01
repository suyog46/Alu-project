document.addEventListener("DOMContentLoaded", function () {
    const images = ["./img/home1.jpg", "./img/home2.jpg", "./img/home3.jpg"];
    let index = 0;

    function changeBackground() {
        const backgroundSlider = document.querySelector(".firstview");
        backgroundSlider.style.backgroundImage = `url(${images[index]})`;

        if (index === images.length - 1) {
            index = 0;
        } else {
            index++;
        }
        setTimeout(changeBackground, 5000); 
    }

    changeBackground();
});
