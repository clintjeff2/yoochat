<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with everyone</title>
    <link rel="shortcut icon" href="../../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="header header-main">
        <img src="../../img/logo.png" alt="Logo image" class="header__logo">
        <div class="header__link">
            <a href="../../index.html">Home</a>
        </div>
        <div class="header__link">
            <a href="../logout/logout.php">Logout</a>
        </div>
        <div class="header__link">
            <a href="index.html">Chat room</a>
        </div>
    </header>
    <main class="chat">
        <div class="chat__nav--top">
            <img src="../../img/lady.jpg" alt="Beautiful lady pictures" class="chat__profile_pic">
            <span class="chat__username">Username</span>
        </div>
        <div class="chat__nav--side">
            Side navigation
        </div>
        <div class="chat__contacts">
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">LMU Engineering</div>
            </div>
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">The Tag Team</div>
            </div>
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">LMU Staff</div>
            </div>
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">Reigns and Rollins</div>
            </div>
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">The Ouzoos</div>
            </div>
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">KO & Jericho </div>
            </div>
            <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">The Ouzoos</div>
            </div>
            <!-- <div class="chat__contacts__group">
                <img src="../../img/profile_image.png" alt="Group chat profile" class="chat__contacts__group__profile">
                <div class="chat__contacts__group__name">The Ouzoos</div>
            </div> -->
            
        </div>
        <div class="chat__main">
            <div class="chat__main__user-message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
            </div>
            <div class="chat__main__user-message my__message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
            </div>
            <div class="chat__main__user-message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
            </div>
            <div class="chat__main__user-message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>   
            </div>
            <div class="chat__main__user-message my__message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At ut maiores fugit magnam quibusdam fuga facilis, nisi neque laudantium numquam nam, soluta doloremque. Aut suscipit praesentium minima itaque, fugiat maiores?</div>   
            </div>
            <div class="chat__main__user-message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
            </div>
            <div class="chat__main__user-message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
            </div>
            <div class="chat__main__user-message my__message">
                <section class="username-and-time">
                    <h4>Username</h4>
                    <div class="message-time">9:45 am</div>
                </section>
                <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
            </div>
        </div>
        <div class="chat__options">
            <form action="" method="post" enctype="multipart/form-data">
                <button class="file__upload" type="button" title="Upload Pictures only">
                    <svg class="upload__icon">
                        <use xlink:href="../../img/sprite.svg#icon-file-picture"></use>
                    </svg>
                </button>
                <input type="file" name="file" class="chat__options__file" placeholder="File"></input>
                <textarea type="text" name="message" id="message" class="chat__options__message" placeholder="Message..." rows="3" cols="40"></textarea>
                <button type="submit" class="chat__options__submit" title="Send message">
                    <svg class="send">
                        <use xlink:href="../../img/sprite.svg#icon-direction"></use>
                    </svg>
                </button>
            </form>
            </form>
        </div>
    </main>
<!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script></body>
</html>