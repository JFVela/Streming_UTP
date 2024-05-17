let currentIndex = 0;
    const images = document.querySelectorAll('.gallery-image');
    const donationMessage1 = document.getElementById('donationMessage1');
    const donationMessage2 = document.getElementById('donationMessage2');

    function showImage(index) {
        images.forEach((img, i) => {
            img.style.display = (i === index) ? 'block' : 'none';
        });
        donationMessage1.style.display = (index === 0) ? 'block' : 'none';
        donationMessage2.style.display = (index === 1) ? 'block' : 'none';
    }

    function prevImage() {
        currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
        showImage(currentIndex);
    }

    function nextImage() {
        currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
        showImage(currentIndex);
    }

    showImage(currentIndex); // Muestra la primera imagen al cargar la página

    let carouselIndex = 0;
    const carouselItems = document.querySelectorAll('.carousel-item');

    function showCarouselItem(index) {
        carouselItems.forEach((item, i) => {
            item.classList.remove('active');
            item.style.transform = `scale(${i === index ? 1 : 0.8})`;
            item.style.opacity = i === index ? 1 : 0.5;
        });
        carouselItems[index].classList.add('active');
    }

    function prevCarousel() {
        carouselIndex = (carouselIndex === 0) ? carouselItems.length - 1 : carouselIndex - 1;
        showCarouselItem(carouselIndex);
    }

    function nextCarousel() {
        carouselIndex = (carouselIndex === carouselItems.length - 1) ? 0 : carouselIndex + 1;
        showCarouselItem(carouselIndex);
    }

    showCarouselItem(carouselIndex);