document.addEventListener('DOMContentLoaded', function () {
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        loop: true,
        loopedSlides: 4, // Add this line
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
            multipleActiveThumbs: false // Add this line
        }
    });

    // Add this event listener to reset sync
    galleryTop.on('slideChange', function () {
        galleryThumbs.slideTo(galleryTop.realIndex);
    });
});
