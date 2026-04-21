/*
The key point is:
👉 AJAX is not something the server “detects.”
👉 It’s just JavaScript deciding how to send the request.

So what actually makes something “AJAX”?

Nothing magical. It’s simply this:

Instead of letting the browser send a request (like a form or link),
you manually send it using JavaScript.

That’s it.

✅ If you let the browser handle the request → page reload
✅ If JavaScript takes over (AJAX) → no reload

The real switch is:
“Did I let the browser handle it, or did I take control with JavaScript?”

Usually done with:
XMLHttpRequest (old way)
fetch() (modern way)
or libraries like jQuery ($.ajax())

$.ajax() comes from jQuery.

It is just a helper function that:

sends HTTP requests using JavaScript
wraps the old XMLHttpRequest API
gives you a cleaner, shorter syntax
*/

$(document).ready(function() {
 displayUsers();
});

function addUser() {
 var name = $('#name').val();
 var email = $('#email').val();
 if(name && email) {
 $.ajax({
 url: 'server.php',
 type: 'POST',
 data: { action: 'add', name: name, email: email },
 success: function(response) {
 $('#userForm')[0].reset();
 displayUsers();
 liveSearch();
 }
 });
 }
}

function displayUsers() {
 $.ajax({
 url: 'server.php',
 type: 'GET',
 data: { action: 'display' },
 success: function(response) {
 $('#userTable').html(response);
 liveSearch();
 }
 });
}

function editUser(id) {
 $.ajax({
 url: 'server.php',
 type: 'GET',
 data: { action: 'getSingleUser', id: id },
 success: function(response) {
 var user = JSON.parse(response);
 var updatedName = prompt("Enter updated name:", user.name);
 var updatedEmail = prompt("Enter updated email:", user.email);
 if (updatedName && updatedEmail) {
 $.ajax({
 url: 'server.php',
 type: 'POST',
 data: { action: 'edit', id: id, name: updatedName, email: updatedEmail },
 success: function() {
 displayUsers();
 }
 });
 }
 }
 });
}

function deleteUser(id) {
 if (confirm("Are you sure you want to delete this user?")) {
 $.ajax({
 url: 'server.php',
 type: 'POST',
 data: { action: 'delete', id: id },
 success: function() {
 displayUsers();
 liveSearch();
 }
 });
 }
}

function liveSearch() {
 var searchValue = $('#search').val();
 $.ajax({
 url: 'server.php',
 type: 'GET',
 data: { action: 'search', search: searchValue },
 success: function(response) {
 $('#searchResults').html(response);
 }
 });
}

