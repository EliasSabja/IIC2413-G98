document.getElementById("in").onchange = function ()
{
  var input = document.getElementById("out");
  input.min = this.value;
}