/*-------slider--------*/
$('.hero-slider').slick({
    autoplay: true,
    infinite: false,
    speeed: 300,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
})
$('.testimonial-slider').slick({
    autoplay: true,
    infinite: false,
    speeed: 300,
    nextArrow: $('.next1'),
    prevArrow: $('.prev1'),
})

const header = document.querySelector('header');

function fixedNavbar() {
    header.classList.toggle('scrolled', window.pageYOffset > 0);
}

fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function() {
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
});

userBtn.addEventListener('click', function() {
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
});

const closeBtn = document.querySelector('#close-form');

closeBtn.addEventListener('click', ()=>{
    document.querySelector('.update-container').style.display='none';
});

$('.popular-product-content').slick({
    lazyLoad: 'ondemand',
    slidesToShow: 4,
    slidesToScroll: 1,
    nextArrow: $('.right'),
    prevArrow: $('.left'),
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
