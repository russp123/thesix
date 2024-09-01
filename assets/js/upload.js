
  const dropzone = document.getElementById('dropzone');
  const fileInput = document.getElementById('fileInput');

  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.style.borderColor = '#fc773f';
  });

  dropzone.addEventListener('dragleave', () => {
    dropzone.style.borderColor = 'rgba(204, 204, 204, 1)';
  });

  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.style.borderColor = 'rgba(204, 204, 204, 1)';
    if (e.dataTransfer.files.length) {
      fileInput.files = e.dataTransfer.files;
      handleFiles(e.dataTransfer.files);
    }
  });

  fileInput.addEventListener('change', (e) => {
    if (fileInput.files.length) {
      handleFiles(fileInput.files);
    }
  });

  function handleFiles(files) {
    // Handle the uploaded files here
    console.log('Files uploaded:', files);
  }
