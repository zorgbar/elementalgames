// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get the necessary elements
    var productContainer = document.querySelector('.product-container');
    var productImages = productContainer.querySelectorAll('.product-image');
    var prevButton = document.querySelector('#prev-button');
    var nextButton = document.querySelector('#next-button');

    // Set the initial index and display the first image
    var currentIndex = 0;
    displayImage();

    // Add event listeners to the navigation buttons
    prevButton.addEventListener('click', showPrevImage);
    nextButton.addEventListener('click', showNextImage);

    // Function to display the current image
    function displayImage() {
        // Hide all images
        productImages.forEach(function (image) {
            image.style.display = 'none';
        });

        // Display the current image
        productImages[currentIndex].style.display = 'block';
    }

    // Function to show the previous image
    function showPrevImage() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = productImages.length - 1;
        }
        displayImage();
    }

    // Function to show the next image
    function showNextImage() {
        currentIndex++;
        if (currentIndex >= productImages.length) {
            currentIndex = 0;
        }
        displayImage();
    }
});