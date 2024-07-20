async function fetchImagesVideos() {
    try {
      const response = await fetch('../../../../temasfull/cms/fetch/fetch_galeri.php');
      const data = await response.json();
  
      const gallery = document.getElementById('gallery');
      gallery.innerHTML = '';
  
      if (data.length > 0) {
        data.forEach(image => {
          const imageElement = document.createElement('img');

          imageElement.src = image.assets;
          imageElement.alt = alt_text;
          imageElement.classList.add('col', 'p-3', 'clickable-image');
          imageElement.dataset.bsToggle = "modal";
          imageElement.dataset.bsTarget = "#details";
          imageElement.style.cursor = "pointer";
          imageElement.style.width = '300px';
          imageElement.style.height = '200px';

          gallery.appendChild(imageElement);
        });

      } else {
        const message = document.createElement('p');
        message.textContent = 'Tidak ada foto/video yang tersedia.';
        message.style.textAlign = 'center';
        message.style.transform = 'translate(0%, 100%)';
        
        gallery.appendChild(message);
      }

      const carousel = document.getElementById('carousel');
      carousel.innerHTML = '';

      if(data.length > 0){
        data.forEach(image => {
          const imageContainer = document.createElement('div');
          const imageElement = document.createElement('img');
          const descriptionElement = document.createElement('p');

          imageContainer.classList.add('carousel-item');
          imageElement.src = image.img_vid_path;
          imageElement.alt = image.alt_text;
          descriptionElement.textContent = image.description;

          carousel.appendChild(imageElement);
          carousel.appendChild(descriptionElement);
        });
      } else {
        const message1 = document.createElement('p');
        message1.textContent = 'Tidak ada foto/video yang tersedia.';
        carousel.appendChild(message1);

        const message2 = document.createElement('p');
        message2.textContent = 'Tidak ada deskripsi yang tersedia.';
        carousel.appendChild(message2);
      }




    } catch (error) {
      console.error('Error fetching images:', error);

    }
  }
  
  document.addEventListener('DOMContentLoaded', fetchImagesVideos);