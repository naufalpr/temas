async function fetchBerita() {
    try {
      const response = await fetch('../../../../temasfull/cms/fetch/fetch_berita.php');
      const data = await response.json();
  
      const thumbnailBerita = document.getElementById('thumbnailBerita');
      thumbnailBerita.innerHTML = '';
  
      if (data.length > 0) {
        data.forEach(article => {
          const articleBerita = document.createElement('article');
          articleBerita.classList.add('mb-5', 'd-flex', 'align-items-start');
          
          const imageThumbnail = document.createElement('img');
          imageThumbnail.src = article.imgPath;
          imageThumbnail.alt = article.alt_text;
          imageThumbnail.className = 'me-3';
          imageThumbnail.style.width = '150px';
          imageThumbnail.style.height = '100px';
          imageThumbnail.style.objectFit = 'cover';

          const articleDiv = document.createElement('div');
          articleDiv.className = 'flex-grow-1';

          const articleTitle = document.createElement('h3');
          articleTitle.textContent = article.title;

          const dateAndAuthor = document.createElement('p');
          const size = document.createElement('small');
          size.textContent = article.date_added;

          const articleDescription = document.createElement('p');
          articleDescription.textContent = article.content;

          const linktoPage = document.createElement('a');
          linktoPage.href = '../../../cms/informasiPublik/berita/template_berita.php?id=${article.id}';
          linktoPage.classList.add('btn', 'btn-primary');
          linktoPage.textContent = 'Selengkapnya';
          
          dateAndAuthor.appendChild(size);
         
          articleDiv.appendChild(articleTitle);
          articleDiv.appendChild(dateAndAuthor);
          articleDiv.appendChild(articleDescription);
          articleDiv.appendChild(linktoPage);

          articleBerita.appendChild(imageThumbnail);
          articleBerita.appendChild(articleDiv);

          thumbnailBerita.appendChild(articleBerita);
          
        });

      } else {
        const message = document.createElement('p');
        message.textContent = 'Tidak ada berita yang tersedia.';
        message.style.textAlign = 'center';
        message.style.transform = 'translate(0%, 100%)';
        
        thumbnail.appendChild(message);
      }

    } catch (error) {
      console.error('Error fetching images:', error);

    }
  }
  
  document.addEventListener('DOMContentLoaded', fetchBerita);