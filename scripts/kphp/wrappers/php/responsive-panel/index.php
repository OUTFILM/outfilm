<?php

require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';

?>

<p class="box">Resize the page to see how the responsive panel hides content.</p>

<div class="dash-head">
    <!-- toggle button for responsive panel, hidden on large screens -->
    <button class="k-rpanel-toggle"><span class="k-icon k-i-hbars"></span></button>
</div>
<div class="panel-wrap">

    <!-- responsive panel, collapsed on small screens -->
<?php
    $responsive_panel = new \Kendo\UI\ResponsivePanel('sidebar');

    $responsive_panel
        ->breakpoint(1000)
        ->orientation("left");

    $responsive_panel
        ->startContent();
?>
        <div id="profile" class="widget">
            <h3>Profile</h3>
            <div>
                <div class="profile-photo"></div>
                <h4>Lynda Schleifer</h4>
                <p>Sales Associate</p>
            </div>
        </div>
        <div id="teammates" class="widget">
            <h3>Teammates</h3>
            <div>
                <div class="team-mate">
                    <img src="../content/web/panelbar/andrew.jpg" alt="Andrew Fuller">
                    <h4>Andrew Fuller</h4>
                    <p>Team Lead</p>
                </div>
                <div class="team-mate">
                    <img src="../content/web/panelbar/nancy.jpg" alt="Nancy Leverling">
                    <h4>Nancy Leverling</h4>
                    <p>Sales Associate</p>
                </div>
                <div class="team-mate">
                    <img src="../content/web/panelbar/robert.jpg" alt="Robert King">
                    <h4>Robert King</h4>
                    <p>Business System Analyst</p>
                </div>
            </div>
        </div>

<?php
    $responsive_panel->endContent();

    echo $responsive_panel->render();
?>

    <div id="main-content">
        <div id="news" class="widget">
            <h3>News</h3>
            <div>

                <h4><span>Jan 22, 2014</span> Stanford Speaker Series Looks at the Rising Tide of Eastern European High Tech Firms with Telerik CEO Vassil Terziev</h4>

                <h4><span>Dec 10, 2013</span> Telerik Test Studio Now Offers Cross-Browser Test Recording and Subscription-Based Pricing for 1M-Strong Developer Community</h4>

                <h4><span>Nov 22, 2013</span> Telerik AD is Named "Best Employer in Bulgaria" for Sixth Consecutive Year</h4>

                <h4><span>Nov 20, 2013</span> Telerik Embraces the Responsive Web with Latest Kendo UI Improvements</h4>
            </div>
        </div>
        <div id="blogs" class="widget">
            <h3>Blogs</h3>
            <div>
                <h4>Upgrading OpenAccess ORM to Telerik Data Access</h4>
                <p class="blog-info">Friday, February 14, 2014 by Data Access Team</p>
                <p>OpenAccess ORM was recently renamed to Telerik Data Access and re-branded. Find out what are the changes you can expect when upgrading to the latest official release.</p>

                <h4>Design, then Develop Experiences</h4>
                <p class="blog-info">Friday, February 14, 2014 by Telerik Services</p>
                <p>Here at Telerik, our goal is to help you develop experiences. We've got a long history of providing tools to help developers deliver great value for their customers. But maybe sometimes you need a little help figuring out just how to make your customers happy. That's where the user experience (UX) designers at Telerik Services come in.</p>

                <h4>What Carl Sagan Taught Me About Software</h4>
                <p class="blog-info">Thursday, February 13, 2014 by Kendo UI</p>
                <p>Software ecosystems are vital to a developer's success. It's hard to place a value on the benefit derived from being able to lean on other's experience, as well as easily find and digest content that's relevant to your project. Ecosystems don't just sprout up overnight though. It takes the right timing, the perfect conditions and lots of love and cultivation. Trying to actively create a new ecosystem around a product or platform is a lot like terraforming. Carl Sagan knows a thing or two about that.</p>
            </div>
        </div>
    </div>
</div>

<style>
    #example {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        overflow: hidden;
    }

    .dash-head {
        width: 970px;
        height: 80px;
        background-color: #222;
        position: relative;
    }

    .dash-head .k-rpanel-toggle {
        position: absolute;
        width: 40px;
        height: 40px;
        top: 20px;
        left: 20px;
    }

    .panel-wrap {
        max-width: 968px;
        background-color: #f5f5f5;
        border: 1px solid #e5e5e5;
    }

    #sidebar {
        margin: 0;
        padding: 20px 0 20px 20px;
        vertical-align: top;
    }

    @media (max-width: 1000px) {
        #sidebar {
            background: #fff;
            padding: 20px;
            border-left: 1px solid #e5e5e5;

            /* show sidebar in container, demo only*/
            position: absolute;
            top: 402px;
            bottom: 0;
        }

        #sidebar.k-rpanel-expanded {
            box-shadow: 0 0 10px rgba(0,0,0,.3);
        }
    }

    #main-content {
        overflow: hidden;
        margin: 0;
        padding: 20px;
        min-height: 580px;
        vertical-align: top;
    }

    /* WIDGETS */
    .widget {
        margin: 0 0 20px;
        padding: 0;
        background-color: #ffffff;
        border: 1px solid #e7e7e7;
        border-radius: 3px;
    }

    .widget div {
        padding: 10px;
        min-height: 50px;
    }

    .widget h3 {
        font-size: 12px;
        padding: 8px 10px;
        text-transform: uppercase;
        border-bottom: 1px solid #e7e7e7;
    }

    .widget h3 span {
        float: right;
    }

    .widget h3 span:hover {
        cursor: pointer;
        background-color: #e7e7e7;
        border-radius: 20px;
    }

    /* PROFILE */
    .profile-photo {
        width: 80px;
        height: 80px;
        margin: 10px auto;
        border-radius: 100px;
        border: 1px solid #e7e7e7;
        background: url('../content/web/Customers/ISLAT.jpg') no-repeat 50% 50%;
    }

    #profile div {
        text-align: center;
    }

    #profile h4 {
        width: auto;
        margin: 0 0 5px;
        font-size: 1.2em;
        color: #1f97f7;
    }

    #profile p {
        margin: 0 0 10px;
    }

    /* BLOGS & NEWS */
    #blogs div,
    #news div {
        padding: 0 20px 20px;
    }

    #teammates h4,
    #blogs h4,
    #news h4 {
        width: auto;
        margin: 20px 0 2px;
        font-size: 1.4em;
        color: #1f97f7;
        font-weight: normal;
    }

    .blog-info {
        margin: 0 0 10px;
        font-size: .9em;
        color: #787878;
    }

    #sidebar #blogs h4 {
        font-size: 1em;
    }

    #sidebar #blogs p {
        display: none;
    }

    #sidebar #blogs .blog-info {
        display: block;
    }

    #main-content #news h4 {
        font-size: 1.2em;
        line-height: 1.4em;
    }

    #main-content #news h4 span {
        display: block;
        float: left;
        width: 100px;
        color: #000;
        padding-right: 10px;
    }

    #sidebar #news h4 {
        font-size: 1em;
    }

    #sidebar #news h4 span {
        display: block;
        margin-bottom: 3px;
        color: #000;
    }

    /* TEAMMATES */
    .team-mate:after {
        content: ".";
        display: block;
        height: 0;
        line-height: 0;
        clear: both;
        visibility: hidden;
    }

    #teammates .team-mate h4 {
        font-size: 1.4em;
        font-weight: normal;
        margin-top: 12px;
    }

    .team-mate p {
        margin: 0;
    }

    .team-mate img {
        float: left;
        margin: 0 15px 0 0;
        border: 1px solid #e7e7e7;
        border-radius: 60px;
    }
</style>

<?php require_once '../include/footer.php'; ?>

