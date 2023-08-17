window.onload = function() {
      var sections = document.querySelectorAll('.section');
      var sectionArr = [];
      for (var i in sections) {
        if (sections[i].nodeType == 1) {                    
          sectionArr.push(sections[i]);
        }
      }
      var newArr = [];
      let sidebar = document.querySelector(".sidebar");
      const newSec = document.createElement("a");
      var elem = sectionArr[0].innerText;
      var elem = elem.replace(/ /g, " ");
      newSec.setAttribute('href', "#" + elem);
      newSec.textContent = elem;
      newSec.setAttribute('class', "border-bottom border-secondary border-1 pt-5 py-2")
      newArr.push(newSec);
      for (var i = 1; i < sectionArr.length; i++) {
        const newSec = document.createElement("a");
        var elem = sectionArr[i].innerText;

        var elem = elem.replace(/ /g, " ");
        newSec.setAttribute('href', "#" + elem);
        newSec.textContent = elem;
        newSec.setAttribute('class', "border-bottom border-secondary border-1 py-2")
        newArr.push(newSec);
      }
      newArr.reverse();
      for (var i in newArr) {
        sidebar.insertBefore(newArr[i], sidebar.firstElementChild.nextSibling);
      }
    }