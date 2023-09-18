<br />
<div id="footer">
</div>

<script>
    console.log(location);
    console.log(location.pathname);
    // don't put the sqlmap helper on pages that aren't intended for practice!
    if(!location.pathname.match("/edit") && !location.pathname.match("/index.php") && !(location.pathname === "/")) {
        var sqlmapCommand=`python -u sqlmap.py -u "${location.href}" --level=3 --risk=2 --dbms=mysql --answers extending=N --flush-session --batch`;
        var code = document.createElement("p");
        code.innerHTML = "Try it with SQLMap (may not work for some pages!): <br /> <code>"+sqlmapCommand+"</code>";
        var footer = document.getElementById('footer');
        footer.appendChild(code);
    }
</script>
