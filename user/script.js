function leave() {
    if (confirm("Bist du dir Sicher?")) {
        location.assign("./leavesession.php");
    }
}