$(document).ready(function () {
$("#testimonials__carousel").owlCarousel({
    loop: true,
    margin: 30,
    nav: false,
    dots: false,
    items: 3,
    center: true,
    autoplay: true,
    autoplayTimeout: 5000,
    navText: ["<i class='icon-left'></i>", "<i class='icon-right'></i>"],
    responsive: {
      1460: {
        items: 3,
        nav: true,
      },
      1280: {
        items: 3,
        nav: true,
      },
      991: {
        items: 2,
        navigatiion: false,
        center: false,
      },
      767: {
        items: 2,
        nav: false,
        center: false,
      },
      575: {
        items: 1,
        nav: false,
      },
      450: {
        items: 1,
        nav: false,
      },
      320: {
        items: 1,
        nav: false,
      },

    }
  });

  AOS.init({
    disable: 'phone', // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 120, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms
    duration: 800, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  });

  const menu = document.querySelector('.menu'),
  body = document.querySelector('body'),
hamburger = document.querySelector('.header__menu'),
close= document.querySelector('.menu__right__close')

  hamburger.addEventListener('click', () => {
    // hamburger.classList.toggle('menu_active');
    body.classList.toggle('lock');
    menu.classList.toggle('menu_active');
  });
  close.addEventListener('click', ()=>{
    // hamburger.classList.remove('menu_active');
    body.classList.remove('lock');
    menu.classList.remove('menu_active');
  });
  
   const filter_main_block = document.querySelector('.filter_main_block'),
  body1 = document.querySelector('body'),
filter_main_btn = document.querySelector('.filter_main_btn'),
close1= document.querySelector('.filter__close')
    
    if(filter_main_btn){
  filter_main_btn.addEventListener('click', () => {
    body1.classList.toggle('filter_lock');
    filter_main_block.classList.toggle('filter_main_active');
  });
  }
  if(close1){
  close1.addEventListener('click', ()=>{
    body1.classList.remove('filter_lock');
    filter_main_block.classList.remove('filter_main_active');
  });
  }
  
  
  
  
   $(".phone").inputmask({
        "mask": "+998 (dd) ddd-dd-dd"
    });
    
    
});