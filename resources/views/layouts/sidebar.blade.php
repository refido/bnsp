<div class="list-group">
    <a href="/dashboard"
        class="list-group-item list-group-item-action <?php if(Request::segment(1)=='dashboard'){ echo "active";} ?>"
        <?php if(Request::segment(1)=='dashboard'){ echo 'aria-current="true"';} ?>>
        Dashboard
    </a>
    <a href="/archive"
        class="list-group-item list-group-item-action <?php if(Request::segment(1)=='archive'){ echo "active";} ?>"
        <?php if(Request::segment(1)=='archive'){ echo 'aria-current="true"';} ?>>Archive</a>
    <a href="/about"
        class="list-group-item list-group-item-action <?php if(Request::segment(1)=='about'){ echo "active";} ?>"
        <?php if(Request::segment(1)=='about'){ echo 'aria-current="true"';} ?>>About</a>
</div>