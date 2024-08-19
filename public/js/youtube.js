var swiper = new Swiper(".slide-content", {
    slidesPerView: 4,
    spaceBetween: 25,
   // slidesPerGroup: 3,
   centerSlide: 'true',
   fade: 'true',
   grabCursor: 'true',
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".arrow-next",
        prevEl: ".arrow-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 4,
        },
    },
});

var swiper = new Swiper(".accueil", {
    slidesPerView: 4,
    spaceBetween: 25,
   // slidesPerGroup: 3,
   centerSlide: 'true',
   fade: 'true',
   grabCursor: 'true',
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
});