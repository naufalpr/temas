async function fetchImages() {
    try {
      const response = await fetch('../../../../temasfull/cms/fetch/fetch_galeri.php'); // Assuming fetch_galeri.php is in cms folder
      const data = await response.json();
  
      const gallery = document.getElementById('gallery');
      gallery.innerHTML = ''; // Clear existing gallery content before adding new images
  
      if (data.length > 0) {
        data.forEach(image => {
          const imageItem = document.createElement('li');
          const imageElement = document.createElement('img');
          const descriptionElement = document.createElement('p');
  
          imageElement.src = image.image_path;
          imageElement.alt = image.alt_text;
          descriptionElement.textContent = image.description;
  
          imageItem.appendChild(imageElement);
          imageItem.appendChild(descriptionElement);
          gallery.appendChild(imageItem);
        });
      } else {
        const message = document.createElement('p');
        message.textContent = 'Tidak ada foto/video yang tersedia.';
        gallery.appendChild(message);
      }
    } catch (error) {
      console.error('Error fetching images:', error);
      // Handle errors gracefully (e.g., display an error message)
    }
  }
  
  // Call the fetchImages function after the DOM is loaded
  document.addEventListener('DOMContentLoaded', fetchImages);