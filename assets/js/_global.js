/*!
 * Swap out no-js for js body class
 */
( function() {
    var c = document.body.className;
    c = c.replace( /no-js/, 'js' );
    document.body.className = c;
})();