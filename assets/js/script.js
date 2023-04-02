window.addEventListener( 'load', function() {
    const swiper = new Swiper(".product-gallery", {
        autoHeight: true,
        spaceBetween: 20,
        loop: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
    });
});