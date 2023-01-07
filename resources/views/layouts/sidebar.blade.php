<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->

<head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="/css/sidebar/style.sidebar.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<div class="sidebar close">
    <div class="logo-details">
        <i class='bx bxs-cube bx-burst bx-rotate-90'></i>
        <span class="logo_name">VPD Business Solutions Inc.</span>
        <span class="logo_name"></span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="/employee">
                    <i class='bx bxs-user-circle'></i>
                    <span class="link_name">Human Resource</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="/employee">Human Resource</a></li>
                {{-- <li><a href="">Employees</a></li> --}}
                <li><a href="">Attendance</a></li>
                <li><a href="">Cash Advance</a></li>
                <li><a href="">Department</a></li>
                <li><a href="">Jobs</a></li>
                <li><a href="">Deductions</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-coin-stack'></i>
                    <span class="link_name">Inventory</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="/inventory">Inventory</a></li>
                <li><a href="/warehouse">Warehouse</a></li>
                <li><a href="/product">Products</a></li>
                <li><a href="/supplier">Supplier</a></li>
                <li><a href="">Purchase Order</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-user-tag"></i>
                    <span class="link_name">Customer</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Customer</a></li>
                <li><a href="">Customer</a></li>
                <li><a href="">Invoice</a></li>
                <li><a href="">Credit Note</a></li>
                <li><a href="">Transactions</a></li>
                <li><a href="">CRM</a></li>

            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-coins"></i>
                    <span class="link_name">Payroll</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Payroll</a></li>
                <li><a href="">Payroll</a></li>
                <li><a href="">Payslip</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-notepad'></i>
                    <span class="link_name">Accounting</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Accounting</a></li>
                <li><a href="">Dashboard</a></li>
                <li><a href="/journal">Journal Entries</a></li>

                <li><a class="link_name" href="#">Journals</a></li>
                <li><a href="">Sales</a></li>
                <li><a href="">Purchase</a></li>
                <li><a href="">Bank & Cash</a></li>
                <li><a href="">Miscellaneous</a></li>

                <li><a class="link_name" href="#">Ledger</a></li>
                <li><a href="">General Ledger</a></li>
                <li><a href="">Partner Ledger</a></li>

                <li><a class="link_name" href="#">Reports</a></li>
                <li><a href="">Trial Balance</a></li>
                <li><a href="">Balance Sheet</a></li>
                <li><a href="">Statement of Changes in Equity</a></li>
                <li><a href="">Income Statement</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-cash-register"></i>
                <span class="link_name">Point Of Sale</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="">Point Of Sale</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Setting</a></li>
                <li><a href="">User Setting</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="" alt="profile">
                </div>

                <div class="name-job">
                    <div class="profile_name"></div>
                    <div class="job">Programmer</div>
                </div>
                <a href=""><i class='bx bx-log-out-circle'></i></a>
            </div>
        </li>
    </ul>
</div>

<section class="home-section" style="z-index: 1;">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text"></span>
    </div>
</section>
@yield('sidebar_content')
<script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
</script>
