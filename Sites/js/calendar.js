document.getElementById("in").onchange = function ()
{
  var input = document.getElementById("out");
  input.min = this.value;
}

document.getElementById("out").onchange = function ()
{
  var input = document.getElementById("in");
  input.max = this.value;
}