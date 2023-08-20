$('#btnSearch').click( function() {
    event.preventDefault();
    var inputValue = document.getElementById('search').value;
    console.log('Input value:', inputValue);
    let filter = inputValue.toLowerCase();
    let objects = $(".col");
    console.log(objects);
    for (let i = 0; i < objects.length; i++) {
        let visible = false;
  
        let title = objects[i].getElementsByTagName("h5")[0];
        let paragraph = objects[i].getElementsByTagName("p");
  
        let array = [];
        array.push(title);
        for (let j = 0; j < paragraph.length; j++) {
          array.push(paragraph[j]);
        }
  
        for (let j = 0; j < array.length; j++) {
          if (array[j]) {
            inputValue = array[j].textContent || array[j].innerText;
            if (inputValue.toLowerCase().indexOf(filter) > -1) {
              visible = true;
            }
          }
        }
  
        if (visible) {
          objects[i].style.display = "";
        } else {
          objects[i].style.display = "none";
        }
      }
});