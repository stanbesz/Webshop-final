function sortBy(method) {
 
              switch (method) {
                case 'newest':
                  var func = function(a, b) {
                    console.log(a.querySelector(".date_true").textContent);
                    return a.querySelector(".date_true").textContent == b.querySelector(".date_true").textContent ?
                      0 :
                      (a.querySelector(".date_true").textContent < b.querySelector(".date_true").textContent ? 1 : -1);
                  }
                  break;
                case 'oldest':
                  var func = function(a, b) {
                    return a.querySelector(".date_true").textContent == b.querySelector(".date_true").textContent ?
                      0 :
                      (a.querySelector(".date_true").textContent > b.querySelector(".date_true").textContent ? 1 : -1);
                  }
                  break;
                case 'expensive':
                  var func = function(a, b) {
                    return parseFloat(a.querySelector(".price_true").textContent) == parseFloat(b.querySelector(".price_true").textContent) ?
                      0 :
                      (parseFloat(a.querySelector(".price_true").textContent) > parseFloat(b.querySelector(".price_true").textContent) ? 1 : -1);
                  }
                  break;
                case 'cheaper':
                  var func = function(a, b) {
                    return parseFloat(a.querySelector(".price_true").textContent) == parseFloat(b.querySelector(".price_true").textContent) ?
                      0 :
                      (parseFloat(a.querySelector(".price_true").textContent) < parseFloat(b.querySelector(".price_true").textContent) ? 1 : -1);
                  }
                  break;
                default:
                  var func = function(a, b) {
                    return parseFloat(a.querySelector(".price_true").textContent) == parseFloat(b.querySelector(".price_true").textContent) ?
                      0 :
                      (parseFloat(a.querySelector(".price_true").textContent) > parseFloat(b.querySelector(".price_true").textContent) ? 1 : -1);
                  }
                  break;
              }
              var lines = document.getElementsByClassName('row_line');
              for (var i in lines) {
                var items = lines[i].children;
                var itemsArr = [];
                for (var j in items) {
                  if (items[j].nodeType == 1) { 
                    itemsArr.push(items[j]);
                  }
                }
                itemsArr.sort(func);
                for (j = 0; j < itemsArr.length; ++j) {
                  lines[i].appendChild(itemsArr[j]);
                }
              }
            }