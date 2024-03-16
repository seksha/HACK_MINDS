// Fetch appointments from doctor.php and append to appointments list
fetch('doctor.php')
  .then(response => response.text())
  .then(data => {
    document.getElementById('appointments-list').innerHTML = data;
  })
  .catch(error => console.error('Error fetching appointments:', error));
