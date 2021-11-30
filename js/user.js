var nombre = "miba";

var cookies = document.cookie.split(";");

for (let i = 0; i < cookies.length; i++) {
  cookies[i] = cookies[i].split("=");
}
console.log(cookies);
