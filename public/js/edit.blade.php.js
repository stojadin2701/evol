function markForDeletion(id)
{
  button = document.getElementById(id);
  button.value = "Undo Delete";
  button.setAttribute("onclick", "undoDelete('" + id + "')");

  markedImages = document.getElementById("markedImages");
  if (markedImages.value == "")
  {
    markedImages.value = id;
  }
  else
  {
      markedImages.value+= ";" + id;
  }
}

function undoDelete(id)
{
  button = document.getElementById(id);
  button.value = "Delete";
  button.setAttribute("onclick", "markForDeletion('" + id + "')");

  markedImages = document.getElementById("markedImages");
  markedImages.value = markedImages.value.replace(";" + id, "");
  markedImages.value = markedImages.value.replace(id, "");
  markedImages.value = markedImages.value.replace(/^;/, "");
}
