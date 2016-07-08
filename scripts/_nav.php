
    <nav class="navbar navbar-fixed-top">
            <div class="nav navbar-nav navbar-left">
                <img src="image/nomi_icon.png" width = "50px">
                <a href="index.php">NOMI</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"   ><img src="image/edit.png" width = "50px"></a>
                  <ul class="dropdown-menu">
                    <li><a  class ="glyphicon glyphicon-log-out" href="#logout"> Logout</a></li>
                    <li><a class = "glyphicon glyphicon-pencil"href="edit.php"> Edit </a></li>
                    <li><a class = "glyphicon glyphicon-envelope"href="#message" id = "message"> Chat Room </a></li>
                  </ul>
                </li>

            </ul>

                <form class="navbar-form navbar-right" role="search">
                  <div class=" form-group">
                    <input type="text" id = "inputbox" class="form-control" placeholder="Search">
                    <ul class="list-group" id="searchresult" style="z-index:1000; position:absolute;">

                    </ul>
                  </div>
                  <button type="submit" class="btn btn-default glyphicon glyphicon-search" name = "searchbtm" id = "searchbtm" ></button>
                </form>

        </div>
    </nav>