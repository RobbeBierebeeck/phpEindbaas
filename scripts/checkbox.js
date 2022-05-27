document.querySelector('#checkbox').addEventListener('change', function(e) {
  if (e.target.checked) {
    document.querySelector('#checkbox-label').classList.add('checked');
  } else {
    document.querySelector('#checkbox-label').classList.remove('checked');
  }
});