<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navbar-scrooll" data-spy="affix"
  data-offset-top="197">
  <div class="container-fluid">
    <img src="lib/upload/ui/logo.jpg" style="width:45px">
    <a class="navbar-brand" href="#" style="color:CornflowerBlue">MACLINK SOLUTIONS</a>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
        </li>
        <li class="nav-item" id="btn_sign">
          <a class="nav-link" href="lib/view/login.php">Sign In</a>
        </li>
        <li class="nav-item" id="btn_reg">
          <a class="nav-link" href="lib/view/register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lib/view/about.php">About</a>
        </li>

        <!-- Drop Down List in Navigation Bar -->
        <li class="nav-item dropdown">
        <div class="form-group">
                    <select class="form-select"  style="background-color:#272B30; border: none; color: 969F9A; cursor: pointer; position: center; margin: 3;" name="productCategory" id="productCategory" placeholder="Add Picture">
                    <option value="0">All Products</option>
                    <option value="Computer">Computer</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Computer Motherboard">Computer Motherboard</option>
                    <option value="Computer Processor">Computer Processor</option>
                    <option value="Computer Power Supply">Computer Power Supply</option>
                    <option value="Computer RAM">Computer RAM</option>
                    <option value="Computer Hard Drive">Computer Hard Drive</option>
                    <option value="Computer Cooling">Computer Cooling</option>
                    <option value="Computer Other Drive">Computer Other Drive</option>
                    <option value="Computer Casing">Computer Casing</option>
                    <option value="Computer Cables">Computer Cables</option>
                    <option value="Computer Other Parts">Computer Other Parts</option>+
                    <option value="Laptop Hard Drive">Laptop Hard Drive</option>
                    <option value="Laptop Display">Laptop Display</option>
                    <option value="Laptop Display">Laptop Display</option>
                    <option value="Laptop Keybord">Laptop Keybord</option>
                    <option value="Laptop Other Parts">Laptop Other Parts</option>
                    <option value="Laptop Accessories">Laptop Accessories</option>
                    <option value="Gaming Accessories">Gaming Accessories</option>
                    <option value="Printers And Accessories">Printers And Accessories</option>
                    <option value="Other Accessories">Other Accessories</option>
                </select>
            </div>
        </li>
      </ul>

      <!-- Search bar in Navigation Bar -->
        <form class="d-flex my-0 mx-1">
          <input class="form-control mx-1 my-0" style="border-radius: 25px;"  type="search" name="searchData" id="searchData" placeholder="search">
        </form>
        <a href="lib/view/cart.php" class=" my-0 mx-0">
          <button type="submit" name="cart" id="cart"  style="border-radius: 25px;" class="btn btn-warning my-0 mx-1">
            <i class="fas fa-shopping-cart"></i>
            <span id='cart_count' style="text-color:white; font-size:20px;" class=''></span>
          </button>
        </a>
        <ul class="navbar-nav">
        <li class="nav-item dropdown" id="btn_user">
          <a class="nav-link dropdown-toggle dropstart" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false"><i class="far fa-user" style="color:#47DBF3"></i></a>
            <div class="dropdown-menu" id="drop0001">
            <!-- style="top: 55;right: -40; margin-top: 0.25rem; margin-right: 2rem;" -->
            <!-- <a class="dropdown-item" href="#">My Account</a> -->
            <a class="dropdown-item" href="lib/view/design.php">My Orders</a>
            <a class="dropdown-item" href="lib/view/design.php">Repair Request</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="lib/function/logout.php"  style="color:red"><i
                class="fas fa-sign-out-alt"></i>Sign Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>