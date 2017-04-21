/* JS to open/close/validate window that opens in index.html when saving to db */

function openWindow() {
  var window = document.getElementById('window');
  window.style.display = "block";
}

function closeWindow() {
  var window = document.getElementById('window');
  window.style.display = "none";
}

function openWindow2() {
  var window = document.getElementById('window-populateDB');
  window.style.display = "block";
}

function closeWindow2() {
  var window = document.getElementById('window-populateDB');
  window.style.display = "none";
}