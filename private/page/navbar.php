<? if($session["user"]["type"] == "member") { ?>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= URL_MAIN ?>"><?= TITLE ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?= URL_MAIN ?>dashboard">Dashboard</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $session["user"]["fullname"] ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?= URL_MAIN ?>member/<?= $session["user"]["id"] ?>">Your Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?= URL_MAIN ?>logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>
<? } elseif($session["user"]["type"] == "advisor") { ?>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= URL_MAIN ?>"><?= TITLE ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?= URL_MAIN ?>dashboard">Dashboard</a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Members <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?= URL_MAIN ?>members">All Members</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Classes</li>
              <? foreach(getgradelist() as $id => $data) { ?>
              <li><a href="<?= URL_MAIN ?>classes/<?= $data ?>">Class of <?= $data ?> (<?= $id ?>th Grade)</a></li>
              <? } ?>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Actions</li>
              <li><a href="<?= URL_MAIN ?>newmember">Add a Member</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Advisors <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?= URL_MAIN ?>advisors">All Advisors</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Actions</li>
              <li><a href="<?= URL_MAIN ?>newadvisor">Add an Advisor</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Conferences <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?= URL_MAIN ?>conferences">List Conferences</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Actions</li>
              <li><a href="<?= URL_MAIN ?>newconference">Add a Conference</a></li>
            </ul>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $session["user"]["fullname"] ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">MMS Settings</a></li>
              <li><a href="<?= URL_MAIN ?>member/<?= $session["user"]["id"] ?>">Your Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?= URL_MAIN ?>logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>
<? } ?>
