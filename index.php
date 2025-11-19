<!DOCTYPE html>
<html lang="pt-PT">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Audiowide&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tektur:wght@400..900&display=swap"
    rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Icons Google -->
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="./css/style.css" />
  <title>GigFlow</title>
</head>

<body>
  <header>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
          <img
            src="./images/black-logo-thumb.png"
            alt="Logo"
            width="100"
            height="60" />
        </a>

        <!-- Mobile Collapse Menu -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarContent"
          aria-controls="navbarContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="./pages/agenda.php">AGENDA</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="./pages/register.php"
                aria-label="Register">REGISTAR</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="./pages/login.php"
                aria-label="Login">LOGIN</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="./pages/profile.php"
                aria-label="Meu Perfil"><i class="fa-solid fa-user"></i>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="./pages/cart.php"
                aria-label="Carrinho"><i class="fa-solid fa-cart-shopping"></i>
              </a>
            </li>
          </ul>
          <form class="d-flex ms-lg-3 position-relative" role="search" id="searchForm" autocomplete="off">
            <input
              class="form-control me-2"
              type="search"
              id="searchInput"
              placeholder="Procurar eventos" />
            <button class="btn btn-outline-light" type="submit">
              <span class="material-symbols-outlined"> search </span>
            </button>
            <div id="searchResults"
              class="list-group position-absolute w-100 mt-5 shadow"
              style="z-index:1000; display:none;">
            </div>
          </form>
        </div>
      </div>
    </nav>

    <!-- Banner Carrousel -->
    <div
      id="carouselExampleFade"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
      data-bs-interval="5000"
      data-bs-touch="false">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            src="./images/shows/rock/iron-maiden.jpg"
            class="d-block w-100"
            alt="Iron Maiden" />
          <div class="carousel-caption text-start top-0 start-0 p-5">
            <h1 class="display-4">Iron Maiden</h1>
            <p class="lead">
              Heavy metal clássico em grande estilo! Eddie, pirotecnia e os maiores hits da banda.
              <br />
              <span>Data:</span> 18-Set-2025
              <br />
              <span>Hora:</span> 21:00
              <br />
              <span>Local:</span> Accor Arena, Paris, França
            </p>
            <a href="./pages/agenda.php" class="btn-color">Ver Agenda</a>
          </div>
        </div>

        <div class="carousel-item">
          <img
            src="./images/shows/pop/shakira.jpg"
            class="d-block w-100"
            alt="Shakira" />
          <div class="carousel-caption text-start top-0 start-0 p-5">
            <h1 class="display-4">Shakira</h1>
            <p class="lead">
              Pop latino contagiante! Coreografias sensacionais cheio de hits internacionais.
              <br />
              <span>Data:</span> 25-Set-2025
              <br />
              <span>Hora:</span> 21:00
              <br />
              <span>Local:</span> Accor Arena, Paris, França
            </p>
            <a href="./pages/agenda.php" class="btn-color">Ver Agenda</a>
          </div>
        </div>

        <div class="carousel-item">
          <img
            src="./images/shows/comedy/Kevin-hart.jpg"
            class="d-block w-100"
            alt="Kevin Hart" />
          <div class="carousel-caption text-start top-0 start-0 p-5">
            <h1 class="display-4">Kevin Hart</h1>
            <p class="lead">
              Risadas garantidas! Kevin Hart apresenta seu stand-up mais recente, histórias hilárias e improvisos que vão fazer você chorar de rir.
              <br />
              <span>Data:</span> 15-Set-2025
              <br />
              <span>Hora:</span> 20:00
              <br />
              <span>Local:</span> O2 Arena, Londres, UK
            </p>
            <a href="./pages/agenda.php" class="btn-color">Ver Agenda</a>
          </div>
        </div>

        <div class="carousel-item">
          <img
            src="./images/shows/festival/Lollapalooza.jpg"
            class="d-block w-100"
            alt="Lollapalooza" />
          <div class="carousel-caption text-start top-0 start-0 p-5">
            <h1 class="display-4">Lollapalooza</h1>
            <p class="lead">
              Três dias de música sem parar! Palcos múltiplos, food trucks, experiências interativas e muita festa!
              <br />
              <span>Data:</span> 12/14-Set-2025
              <br />
              <span>Hora:</span> 12:00 - 23:00
              <br />
              <span>Local:</span> Berlin Tempelhof, Alemanha
            </p>
            <a href="./pages/agenda.php" class="btn-color">Ver Agenda</a>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleFade"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleFade"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </header>

  <main>
    <!-- UPCOMING EVENTS SECTION -->
    <section class="upcoming container py-5">
      <div class="upcoming-title text-center mb-4">
        <h2>UPCOMING EVENTS</h2>
        <hr>
      </div>

      <div class="row g-4">
        <div class="col-md-4 col-lg-3">
          <div class="card">
            <img
              src="./images/shows/rock/green-day.jpg"
              class="card-img-top"
              alt="Green Day" />
            <div class="card-body">
              <h5 class="card-title">Green Day</h5>
              <p class="card-text">
                Green Day detona Londres com punk rock explosivo.
              </p>
              <a href="./pages/artist-bio/green_day.html" class="btn-color">Ver Detalhes</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card">
            <img
              src="./images/shows/rock/red-hot-chilli-peppers.jpg"
              class="card-img-top"
              alt="Red Hot Chilli Peppers" />
            <div class="card-body">
              <h5 class="card-title">Red Hot Chilli Peppers</h5>
              <p class="card-text">
                RHCP trazem funk rock contagiante para Amsterdã.
              </p>
              <a href="./pages/artist-bio/red_hot_chilli.html" class="btn-color">Ver Detalhes</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card">
            <img
              src="./images/shows/pop/billie-eilish.jpg"
              class="card-img-top"
              alt="Billie Eilish" />
            <div class="card-body">
              <h5 class="card-title">Billie Eilish</h5>
              <p class="card-text">
                Billie Eilish faz Paris mergulhar em um show imersivo.
              </p>
              <a href="./pages/artist-bio/billie_eilish.html" class="btn-color">Ver Detalhes</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card">
            <img
              src="./images/shows/pop/harry-styles.jpg"
              class="card-img-top"
              alt="Harry Styles" />
            <div class="card-body">
              <h5 class="card-title">Harry Styles
              </h5>
              <p class="card-text">
                Harry Styles encanta Londres com pop elegante.
              </p>
              <a href="./pages/artist-bio/harry_styles.html" class="btn-color">Ver Detalhes</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- COMIC SHOW -->
    <section class="show-section container py-5">
      <div class="show-title text-center mb-4">
        <h2>GIG COMÉDIA</h2>
        <hr>
      </div>

      <!-- Kevin Hart -->
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
          <div class="card">
            <img src="./images/shows/comedy/Kevin-hart.jpg" class="card-img-top" alt="Kevin Hart">
            <div class="card-body">
              <h5 class="card-title">Kevin Hart</h5>
              <p class="card-text">🎭 Um espetáculo de 1h40min de stand-up cheio de histórias pessoais hilárias, improvisos e energia que só Kevin sabe entregar. Risos garantidos do início ao fim.
                <br><br>
                ⏱️ <strong>15 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>O2 Arena, Londres, UK</strong>
                <br><br>
                <a href="./pages/artist-bio/kevin_hart.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Ali Wong -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/comedy/Ali-wong.jpg" class="card-img-top" alt="Ali Wong">
            <div class="card-body">
              <h5 class="card-title">Ali Wong</h5>
              <p class="card-text">🤣 Uma noite de 1h30min de humor ácido e irreverente. Ali mistura experiências pessoais com críticas afiadas da sociedade moderna, arrancando gargalhadas do público europeu.
                <br><br>
                ⏱️ <strong>16 de Setembro de 2025, 19:30</strong>
                <br>
                📍 <strong>Ziggo Dome, Amsterdã, Países Baixos</strong>
                <br><br>
                <a href="./pages/artist-bio/ali_wong.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- John Mulaney -->
        <div class="col">
          <div class="card">
            <img src="./images//shows/comedy/John-mulaney.jpg" class="card-img-top" alt="John Mulaney">
            <div class="card-body">
              <h5 class="card-title">John Mulaney</h5>
              <p class="card-text">😆 Uma apresentação de 1h45min de humor inteligente e observacional. John transforma o cotidiano em situações absurdamente engraçadas.
                <br><br>
                ⏱️ <strong>19 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>Accor Arena, Paris, França</strong>
                <br><br>
                <a href="./pages/artist-bio/john_mulaney.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Hannah Gadsby -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/comedy/Hannah-Gadsby.jpg" class="card-img-top" alt="Hannah Gadsby">
            <div class="card-body">
              <h5 class="card-title">Hannah Gadsby</h5>
              <p class="card-text">🎭 Um stand-up de 2h inovador que mistura risos, reflexão e surpresa. Hannah quebra padrões e entrega um show memorável.
                <br><br>
                ⏱️ <strong>21 de Setembro de 2025, 20:30</strong>
                <br>
                📍 <strong>Royal Arena, Copenhague, Dinamarca</strong>
                <br><br>
                <a href="./pages/artist-bio/hannah_gadsby.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Trevor Noah -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/comedy/Trevor-noah.jpg" class="card-img-top" alt="Trevor Noah">
            <div class="card-body">
              <h5 class="card-title">Trevor Noah</h5>
              <p class="card-text">😂 Stand-up global de 1h50min! Trevor aborda política, cultura e diferenças culturais com inteligência e carisma irresistíveis.
                <br><br>
                ⏱️ <strong>24 de Setembro de 2025, 19:45</strong>
                <br>
                📍 <strong>Lanxess Arena, Colônia, Alemanha</strong>
                <br><br>
                <a href="./pages/artist-bio/trevor_noah.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- POP SHOW -->
    <section class="show-section container py-5">
      <div class="show-title text-center mb-4">
        <h2>GIG POP</h2>
        <hr>
      </div>

      <!-- Billie Eilish -->
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
          <div class="card">
            <img src="./images/shows/pop/billie-eilish.jpg" class="card-img-top" alt="Billie Eilish">
            <div class="card-body">
              <h5 class="card-title">Billie Eilish</h5>
              <p class="card-text">🌟 Um espetáculo cinematográfico de 1h45min. Billie transforma o palco com visuais sombrios, projeções intensas e um ambiente imersivo que faz cada fã se sentir parte da narrativa.
                <br><br>
                ⏱️ <strong>13 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>Accor Arena, Paris, França</strong>
                <br><br>
                <a href="./pages/artist-bio/billie_eilish.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Harry Styles -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/pop/harry-styles.jpg" class="card-img-top" alt="Harry Styles">
            <div class="card-body">
              <h5 class="card-title">Harry Styles</h5>
              <p class="card-text">🌈 Um show de 2h15min que mistura pop, rock e momentos intimistas. Harry entrega vocais poderosos, charme e uma conexão especial com o público.
                <br><br>
                ⏱️ <strong>17 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>O2 Arena, Londres, UK</strong>
                <br><br>
                <a href="./pages/artist-bio/harry_styles.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Katy Perry -->
        <div class="col">
          <div class="card">
            <img src="./images//shows/pop/katy-perry.jpg" class="card-img-top" alt="Katy Perry">
            <div class="card-body">
              <h5 class="card-title">Katy Perry</h5>
              <p class="card-text">🎉 Um espetáculo teatral de 2h cheio de cores, figurinos ousados e hits inesquecíveis. Katy transforma o palco em uma festa pop vibrante do começo ao fim.
                <br><br>
                ⏱️ <strong>21 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>Ziggo Dome, Amsterdã, Países Baixos</strong>
                <br><br>
                <a href="./pages/artist-bio/katy_perry.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Olivia Rodrigo -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/pop/olivia-rodrigo.jpg" class="card-img-top" alt="Olivia Rodrigo">
            <div class="card-body">
              <h5 class="card-title">Olivia Rodrigo</h5>
              <p class="card-text">🎤 Um show de 1h50min de pop-rock visceral. Olivia conecta-se intensamente com fãs, cantando sucessos emocionantes em um clima energético e autêntico.
                <br><br>
                ⏱️ <strong>23 de Setembro de 2025, 19:30</strong>
                <br>
                📍 <strong>Lanxess Arena, Colônia, Alemanha</strong>
                <br><br>
                <a href="./pages/artist-bio/olivia_rodrigo.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Shakira -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/pop/shakira.jpg" class="card-img-top" alt="Shakira">
            <div class="card-body">
              <h5 class="card-title">Shakira</h5>
              <p class="card-text">💃 Dois horas de pop latino envolvente, com coreografias marcantes e uma explosão de ritmo multicultural. Shakira transforma Paris em uma verdadeira festa.
                <br><br>
                ⏱️ <strong>25 de Setembro de 2025, 21:00</strong>
                <br>
                📍 <strong>Accor Arena, Paris, França</strong>
                <br><br>
                <a href="./pages/artist-bio/shakira.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ROCK SHOW -->
    <section class="show-section container py-5">
      <div class="show-title text-center mb-4">
        <h2>GIG ROCK</h2>
        <hr>
      </div>

      <!-- Green Day -->
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
          <div class="card">
            <img src="./images/shows/rock/green-day.jpg" class="card-img-top" alt="Green Day">
            <div class="card-body">
              <h5 class="card-title">Green Day</h5>
              <p class="card-text">🔥 Um show de 2h30min de punk rock explosivo! Clássicos como “American Idiot” e “Basket Case”, iluminação épica e uma interação que transforma a arena em um coro de milhares de vozes. Energia pura do início ao fim.
                <br><br>
                ⏱️ <strong>12 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>O2 Arena, Londres, UK</strong>
                <br><br>
                <a href="./pages/artist-bio/green_day.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Foo Fighters -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/rock/foo-fighters.jpg" class="card-img-top" alt="Foo Fighters">
            <div class="card-body">
              <h5 class="card-title">Foo Fighters</h5>
              <p class="card-text">🤘 Um espetáculo de 2h40min liderado por Dave Grohl. Guitarras intensas, momentos emocionantes e um setlist que atravessa décadas de hits. Wembley vira palco de pura catarse coletiva.
                <br><br>
                ⏱️ <strong>14 de Setembro de 2025, 19:30</strong>
                <br>
                📍 <strong>Wembley Stadium, Londres, UK</strong>
                <br><br>
                <a href="./pages/artist-bio/foo_fighters.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Iron Maiden -->
        <div class="col">
          <div class="card">
            <img src="./images//shows/rock/iron-maiden.jpg" class="card-img-top" alt="Iron Maiden">
            <div class="card-body">
              <h5 class="card-title">Iron Maiden</h5>
              <p class="card-text">⚡ Uma noite de 2h45min de heavy metal clássico, com Eddie no palco, pirotecnia de arrepiar e os hinos que marcaram gerações. A força de uma lenda viva do metal em Paris.
                <br><br>
                ⏱️ <strong>18 de Setembro de 2025, 21:00</strong>
                <br>
                📍 <strong>Accor Arena, Paris, França</strong>
                <br><br>
                <a href="./pages/artist-bio/iron_maiden.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Red Hot Chili Peppers -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/rock/red-hot-chilli-peppers.jpg" class="card-img-top" alt="Red Hot Chili Peppers">
            <div class="card-body">
              <h5 class="card-title">Red Hot Chili Peppers</h5>
              <p class="card-text">🎸 Funk rock vibrante em 2h10min de show contagiante. Flea e Anthony Kiedis comandam um espetáculo cheio de improviso, hits dançantes e energia inigualável.
                <br><br>
                ⏱️ <strong>20 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>Ziggo Dome, Amsterdã, Países Baixos</strong>
                <br><br>
                <a href="./pages/artist-bio/red_hot_chilli.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Arctic Monkeys -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/rock/artic-monkeys.jpg" class="card-img-top" alt="Arctic Monkeys">
            <div class="card-body">
              <h5 class="card-title">Arctic Monkeys</h5>
              <p class="card-text">🌙 Um show de 2h de indie rock atmosférico. Alex Turner mistura hits nostálgicos com novas camadas sonoras, criando uma experiência íntima mesmo em uma arena gigante.
                <br><br>
                ⏱️ <strong>26 de Setembro de 2025, 20:00</strong>
                <br>
                📍 <strong>Royal Arena, Copenhague, Dinamarca</strong>
                <br><br>
                <a href="./pages/artist-bio/artic_monkeys.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FESTIVAL SHOW -->
    <section class="show-section container py-5">
      <div class="show-title text-center mb-4">
        <h2>GIG FESTIVAL</h2>
        <hr>
      </div>

      <!-- Lollapalooza Berlin -->
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
          <div class="card">
            <img src="./images/shows/festival/Lollapalooza.jpg" class="card-img-top" alt="Lollapalooza Berlin">
            <div class="card-body">
              <h5 class="card-title">Lollapalooza Berlin</h5>
              <p class="card-text">🌟 Dois dias de pura energia musical! Mais de 22h de shows com Tame Impala, Doja Cat, Travis Scott e Florence + The Machine, palcos espetaculares, iluminação incrível, zonas interativas, arte urbana e gastronomia internacional.
                <br><br>
                ⏱️ <strong>06 - 07 de Setembro de 2025, 12:00 - 23:00</strong>
                <br>
                📍 <strong>Berlin Tempelhof, Alemanha</strong>
                <br><br>
                <a href="./pages/artist-bio/lollapalooza.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Download Festival UK -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/festival/Download.jpg" class="card-img-top" alt="Download Festival UK">
            <div class="card-body">
              <h5 class="card-title">Download Festival UK</h5>
              <p class="card-text">🤘 Três dias de rock e metal intensos! Headliners: Slipknot, Metallica e Bring Me The Horizon. Palco monumental, pirotecnia épica, camping e atmosfera de verdadeira comunidade de fãs. Imperdível!
                <br><br>
                ⏱️ <strong>19 - 21 de Setembro de 2025, 14:00 - 23:30</strong>
                <br>
                📍 <strong>Donington Park, Reino Unido</strong>
                <br><br>
                <a href="./pages/artist-bio/download_festival.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Tomorrowland -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/festival/Tomorrowland.jpg" class="card-img-top" alt="Tomorrowland">
            <div class="card-body">
              <h5 class="card-title">Tomorrowland</h5>
              <p class="card-text">🎧 40h de música eletrônica em palcos cinematográficos. DJs: Martin Garrix, Charlotte de Witte, Carl Cox, Swedish House Mafia. Fogos, lasers e experiências sensoriais fazem cada segundo inesquecível!
                <br><br>
                ⏱️ <strong>26 - 28 de Setembro de 2025, 16:00 - 03:00</strong>
                <br>
                📍 <strong>Boom, Bélgica</strong>
                <br><br>
                <a href="./pages/artist-bio/tomorrowland.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Rock in Rio Lisboa -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/festival/Rock-in-rio.jpg" class="card-img-top" alt="Rock in Rio Lisboa">
            <div class="card-body">
              <h5 class="card-title">Rock in Rio Lisboa</h5>
              <p class="card-text">🌍 Três dias com 30h de música e performances de Muse, Ed Sheeran, Coldplay e Imagine Dragons. Palcos gigantescos, efeitos visuais, gastronomia e experiências interativas criam uma imersão total.
                <br><br>
                ⏱️ <strong>10 - 12 de Outubro de 2025, 17:00 - 00:30</strong>
                <br>
                📍 <strong>Parque da Bela Vista, Portugal</strong>
                <br><br>
                <a href="./pages/artist-bio/rock_in_rio.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Creamfields UK -->
        <div class="col">
          <div class="card">
            <img src="./images/shows/festival/Creamfields.jpg" class="card-img-top" alt="Creamfields UK">
            <div class="card-body">
              <h5 class="card-title">Creamfields UK</h5>
              <p class="card-text">⚡ Três dias de 36h de música eletrônica nonstop. DJs: David Guetta, Peggy Gou, Tiësto, Amelie Lens. Palcos futuristas, pirotecnia e experiências imersivas criam uma festa sem limites.
                <br><br>
                ⏱️ <strong>17 - 19 de Outubro de 2025, 15:00 - 03:00</strong>
                <br>
                📍 <strong>Daresbury, Reino Unido</strong>
                <br><br>
                <a href="./pages/artist-bio/creamfields.html" class="btn-nohover">Ver Detalhes</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer py-4 mt-5">
    <div class="container text-center">
      <div class="row align-items-center gy-4">

        <!-- Social Media -->
        <div class="col-md-4">
          <h5>Redes Sociais</h5>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- Logo -->
        <div class="col-md-4">
          <img src="./images/black-logo-thumb.png" alt="Gig Flow Logo" class="footer-logo">
        </div>

        <!-- Contact -->
        <div class="col-md-4">
          <h5>Contacto</h5>
          <p><i class="fa-solid fa-phone"></i> 00352 098 098 055</p>
          <p><i class="fa-solid fa-house"></i> Rue Morgane Lai, 22</p>
        </div>
      </div>
      <hr class="my-4">
      <p class="text-center mb-0">&copy; 2025 GigFlow. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Bootstrap Script -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous">
  </script>

  <script>
    // Search Bar function
    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");

      searchInput.addEventListener("keyup", () => {
        const query = searchInput.value.trim();

        if (query.length < 2) {
          searchResults.style.display = "none";
          return;
        }

        fetch(`./php/search_events.php?q=${encodeURIComponent(query)}`)
          .then(res => res.text())
          .then(html => {
            searchResults.innerHTML = html;
            searchResults.style.display = html.trim() ? "block" : "none";
          })
        .catch(err => console.error(err));
      });

    document.addEventListener("click", (e) => {
      if (!searchResults.contains(e.target) && e.target !== searchInput) {
        searchResults.style.display = "none";
      }
    });

</script>
</body>

</html>