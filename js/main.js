    function usersRequest(userdata, method, id, onSuccess, onFalse) {
      var data = new FormData();
      data.append("path" , 'data/users/' + id + '.json');
      if(userdata != null) {
        data.append("data" , JSON.stringify(userdata)); 
      }

      var xhr = CORSRequest('POST', 'jsonDB/scripts/users/' + method + '.php');

      xhr.onload = function () {       
        onSuccess(xhr.responseText);
      };

      if(onFalse != null) {
        xhr.onerror = function () {       
          onFalse(xhr.responseText);
        };
      }
      
      xhr.send(data);
    }

    function articlesRequest(userdata, method, onSuccess, onFalse) {
      var data = new FormData();
      if(userdata != null) {
        data.append("data" , JSON.stringify(userdata)); 
      }

      var xhr = CORSRequest('POST', 'jsonDB/scripts/articles2/' + method + '.php');

      xhr.onload = function () {       
        onSuccess(xhr.responseText);
      };

      if(onFalse != null) {
        xhr.onerror = function () {       
          onFalse(xhr.responseText);
        };
      }
      
      xhr.send(data);
    }

    function addArticle(link, interests, onSuccess) {
      var sum = interests.reduce(function(a, b) { return a + b; }, 0);

      articledata = {}
      articledata['themesId'] = ("0" + sum).slice(-2);
      articledata['link'] = link;

      articlesRequest(articledata, 'create', onSuccess);
    }

    function deleteArticle(id, onSuccess) {
      articlesRequest(id, 'delete', onSuccess);
    }

    function getArticle(id, onSuccess) {
      var xhr = CORSRequest('GET', 'jsonDB/scripts/articles2/read.php?data=' + id);

      xhr.onload = function () {       
        onSuccess(xhr.responseText);
      };

      xhr.send();
    }

    function getNewArticles(count, offset, onSuccess) { // if authorized user it can be getNewArticlesByInterests
      data = {}
      data['count'] = count;
      data['offset'] = offset;

      articlesRequest(data, 'readNew', onSuccess);
    }

    function getArticlesByInterest(themeId, count, offset, onSuccess) { // Temporary of getArticlesByInterests      
      articledata = {}
      articledata['themesId'] = ("0" + themeId).slice(-2);
      articledata['count'] = count;
      articledata['offset'] = offset;

      articlesRequest(articledata, 'readTheme', onSuccess);
    }

    function getArticlesByInterests(interests, count, offset, onSuccess) {

      // FROM HS WE ARE SENDING SUM OG INTERESTS
      // IN PHP WE SHOULD GIVE ALL THEMES FROM THIS SUM
      // FOR FIRST RETURN THEMES BY FULL SUM
      // AFTER SUM - 1 THEME atd.

      /*var sum = interests.reduce(function(a, b) { return a + b; }, 0);

      articledata = {}
      articledata['themesId'] = ("0" + sum).slice(-2);
      articledata['count'] = count;
      articledata['offset'] = offset;

      articlesRequest(articledata, 'readThemes', onSuccess);*/
    }

    // TELEGRA.PH
    function CORSRequest(method, url) {
        var xhr = new XMLHttpRequest();
        if ('withCredentials' in xhr) {
            // Chrome / Firefox / Opera / Safari
            xhr.open(method, url, true);
        } else if (typeof XDomainRequest != 'undefined') {
            // IE
            xhr = new XDomainRequest();
            xhr.open(method, url);
        } else {
            xhr = null;
        }
        return xhr;
    }

    /*function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }*/

    function loadArticle(url, id) {   
        if(window.location.pathname != "/article/" + id) {
          window.history.pushState("MRM", url, "/article/" + id);
        }

        var xhr = CORSRequest('GET', 'http://myrealmotivation.com/getarticle?url=http://telegra.ph/' + url);

        xhr.onload = function () { 

          console.log(xhr.responseText);

          if(document.getElementById("copyrightFooter")) {
            document.getElementById("copyrightFooter").style = "display:none;";
          }

          var loaderDiv = document.createElement('div');
          loaderDiv.id = "loaderDiv";
          loaderDiv.innerHTML = `<div id="preloader">
                                    <div id="loader"></div>
                                 </div>`

          $(webBody).html(loaderDiv);

          var data = xhr.responseText;
          data = data +
          `<script type="text/javascript">
              var interval = setInterval(function() {    
                if(document.getElementById("loaderDiv")) {
                  document.getElementById("loaderDiv").style = 'display:none';
                }
                if(document.getElementById("` + id + `")) {
                  document.getElementById("` + id + `").style.display = 'block';
                }
                document.getElementById("copyrightFooter").style = "display:block;";
                clearInterval(interval);
            }, 500);
           </script>`;

          var marginDiv = document.createElement('div');
          marginDiv.id = id;     
          marginDiv.style.marginTop = "50px";
          marginDiv.style.display = "none";
          marginDiv.innerHTML = data;         
      
          $(webBody).append(marginDiv);
        };

        xhr.send();
    }

    const ThemeTemplate = ({ id, url, img, title, description }) => `
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href='?article${id}' onclick='loadArticle("${url}", ${id}); return false;'><img class="card-img-top" src="${img}" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href='?article${id}' onclick='loadArticle("${url}", ${id}); return false;'>${title}</a>
                    </h4>
                    <p class="card-text">${description}</p>
                    <div class="card-footer">
                        <a href='?article${id}' onclick='loadArticle("${url}", ${id}); return false;' class="btn btn-primary">Motivate</a>
                    </div>
                </div>
            </div>
        </div>`;
   
    function getPreview(listId, loaderId, shorturl, id) {
        var xhr = CORSRequest('GET', 'http://myrealmotivation.com/getpreview?url=http://telegra.ph/' + shorturl);

        xhr.onload = function () {
            var data = JSON.parse(xhr.responseText);
            $(listId).append(ThemeTemplate ({
                id: id,
                url: shorturl,
                img: data['img'], 
                title: data['title'], 
                description: data['description']
            }));

            var element = document.getElementById(loaderId);
            if (element != null) {
              element.outerHTML = '';
              delete element;
            }
        };

        xhr.send();
    }

    // Global variable, used in loadPage() and on articles.html
    var themesDict = { 'it':1, 'life':2, 'sport':3, 'education':4, 'family':5, 'business':6 }

    function loadPage(pageId) {
      var pages = ['register', 'login', 'profile', 'contact', 'about', 'faq', 'profile'];
      var themes = Object.keys(themesDict);

      if(pages.includes(pageId)) {
        filename = pageId + '.html';
      } 
      else if(pageId == '') {
        filename = 'main.html';
      }
      else if(pageId.lastIndexOf("article/", 0) === 0) {
        return;
      }
      else if(pageId == 'articles' || themes.includes(pageId)) {
        filename = 'articles.html';
      }
      else if(pageId == 'confirm') {
        if(document.getElementById("Gusername").value !== "") {
          filename = 'register2.html';
        }
        else {
          pageId == '404';
          filename = '404.html';
        }    
      }
      else if(pageId == 'complete') {
        if(document.getElementById("Gusername").value !== "" 
          && document.getElementById("GuserId").value !== ""
          && document.getElementById("Gmail").value !== ""
          && document.getElementById("Gname").value !== ""
        ) {
          filename = 'register3.html';
        }
        else {
          pageId == '404';
          filename = '404.html';
        }    
      }
      else {
        pageId == '404';
        filename = '404.html';
      }

        $.get('/templates/' + filename)
        .done((data) => {

          if(pageId != 'complete') { // unbind "ask" before update/close
              data = `<script type="text/javascript"> 
                $(window).unbind("beforeunload");</script>` + data
          }
          
          if(pageId == 'articles') {
            document.getElementById("Garticles").value = '0';
            data = data.replace(/\${title}/g, "New"); // Change titles
          }
          else if(themes.includes(pageId)) {
            data = data.replace(/\${title}/g, pageId.toUpperCase()); // Change titles       
          }

          $(webBody).html(data); // Change body data
          
          if(window.location.pathname != "/" + pageId) {
            window.history.pushState("MRM", pageId.toUpperCase(), "/" + pageId);
          }
        });
    }

