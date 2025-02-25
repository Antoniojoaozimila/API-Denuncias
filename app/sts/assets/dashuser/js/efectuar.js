document.getElementById('imagem').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    preview.innerHTML = ''; // Limpa a pré-visualização anterior
  
    const files = e.target.files;
    if (files) {
      [...files].forEach(file => {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          
          const removeBtn = document.createElement('span');
          removeBtn.innerText = 'X';
          removeBtn.classList.add('remove-image');
          removeBtn.addEventListener('click', function() {
            img.remove();
            removeBtn.remove();
          });
          
          const container = document.createElement('div');
          container.appendChild(img);
          container.appendChild(removeBtn);
          preview.appendChild(container);
        }
        
        reader.readAsDataURL(file);
      });
    }
  });
  