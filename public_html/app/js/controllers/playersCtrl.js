'use strict';

/* Controllers */

angular.module('myApp.controllers', [])
.controller('playersCtrl', ['$scope', 'Data', 'Reports', function($scope, data, reports) {

    var reportFilter = null;

    $scope.sel_d = [];
    $scope.sel_m = [];
    $scope.sel_f = [];
    $scope.sel_k = [];
    $scope.curr_money = 75.0;

    $scope.chooseplayer = function(p){
        // p.first_name,p.second_name,p.posn,p.id,p.now_cost/10
        var pfirstname = p.first_name;
        var plastname = p.second_name;
        var position = p.posn;
        var id = p.id;
        var cost = p.now_cost/10;
        if (document.getElementById(id).checked) {
            $scope.Jatinvar = pfirstname + ' ' + plastname;
            if(position == "D") {
                if($scope.curdefenders == $scope.defenders) {
                    alert("Overflow");
                    document.getElementById(id).checked = false;
                }
                else {
                    var num = $scope.forwards + $scope.midfielders + $scope.curdefenders;
                    document.getElementById('p'+num.toString()).innerHTML = pfirstname + ' ' + plastname;
                    $scope.curdefenders++;
                    $scope.curr_money -= cost;
                    $scope.sel_d.push(p.id);
                    document.getElementById("money").innerHTML = "Money remaining: $" + $scope.curr_money.toPrecision(3).toString() + " million";
                }
            }
            else if(position == "M") {
                if($scope.curmidfielders == $scope.midfielders) {
                    alert("Overflow");
                    document.getElementById(id).checked = false;
                }
                else {
                    var num = $scope.forwards + $scope.curmidfielders;
                    document.getElementById('p'+num.toString()).innerHTML = pfirstname + ' ' + plastname;
                    $scope.curmidfielders++;
                    $scope.curr_money -= cost;
                    $scope.sel_m.push(p.id);
                    document.getElementById("money").innerHTML = "Money remaining: $" + $scope.curr_money.toPrecision(3).toString() + " million";
                }
            }
            else if(position == "F") {
                if($scope.curforwards == $scope.forwards) {
                    alert("Overflow");
                    document.getElementById(id).checked = false;
                }
                else {
                    var num = $scope.curforwards;
                    document.getElementById('p'+num.toString()).innerHTML = pfirstname + ' ' + plastname;
                    $scope.curforwards++;
                    $scope.curr_money -= cost;
                    $scope.sel_f.push(p.id);
                    document.getElementById("money").innerHTML = "Money remaining: $" + $scope.curr_money.toPrecision(3).toString() + " million";
                }
            }
            else if(position == "K") {
                if($scope.curkeepers == 1) {
                    alert("Overflow");
                    document.getElementById(id).checked = false;
                }
                else {
                    document.getElementById("p10").innerHTML = pfirstname + ' ' + plastname;
                    $scope.curkeepers++;
                    $scope.curr_money -= cost;
                    $scope.sel_k.push(p.id);
                    document.getElementById("money").innerHTML = "Money remaining: $" + $scope.curr_money.toPrecision(3).toString() + " million";
                }
            }

        }
        else {
            $scope.Jatinvar = pfirstname + ' ' + plastname;
            for (var num = 0; num < 11; num++) {
                if (document.getElementById('p'+num.toString()).innerHTML == $scope.Jatinvar) {
                    document.getElementById('p'+num.toString()).innerHTML = "Select Player";
                    $scope.curr_money += cost;
                    document.getElementById("money").innerHTML = "Money remaining: $" + $scope.curr_money.toPrecision(3).toString() + " million";
                    if (position == 'D') {
                        $scope.curdefenders--;
                        var idx = $scope.sel_d.indexOf(p.id);
                        $scope.sel_d.splice(idx,1);
                    }
                    if (position == 'M') {
                        $scope.curmidfielders--;
                        var idx = $scope.sel_m.indexOf(p.id);
                        $scope.sel_m.splice(idx,1);
                    }
                    if (position == 'F') {
                        $scope.curforwards--;
                        var idx = $scope.sel_f.indexOf(p.id);
                        $scope.sel_f.splice(idx,1);
                    }
                    if (position == 'K') {
                        $scope.curkeepers--;
                        var idx = $scope.sel_k.indexOf(p.id);
                        $scope.sel_k.splice(idx,1);
                    }
                }
            }
        }

        var num = $scope.curdefenders + $scope.curmidfielders + $scope.curforwards + $scope.curkeepers;
        if (num == 11) {
            var continueButton = document.getElementById("continue");
            continueButton.setAttribute("class", "btn btn-success btn-lg");
        }
        else  {
            var continueButton = document.getElementById("continue");
            continueButton.setAttribute("class", "btn btn-success btn-lg disabled");
        }
    };

    $scope.selectplayer = function(){
        alert("hi");
        $scope.aname = $scope.Jatinvar;
    };

    $scope.createRow = function() {
        var row = document.createElement("div");
        row.style.display = "flex";
        row.justifyContent = "center";
        row.alignContent = "center";
        row.style.padding = "5%";
        return row;
    };

    function checking() {
        //alert("hi");
        $scope.aname = $scope.Jatinvar;

        //document.getElementById(t).innerHTML = $scope.aname;
        // document.getElementById(2).innerHTML = $scope.aname;
        // var t = parseInt(event.srcElement.id);
        // $scope.newid = t;
        document.getElementById(this.id).innerHTML = $scope.aname;
        $scope.$digest();

    };

    $scope.createPlayerIcon = function(position,id) {
        var playericon = document.createElement("button");
        playericon.setAttribute("class", "btn btn-secondary btn-lg");
        playericon.style.opacity = "0.8";
        playericon.style.margin = "auto";
        playericon.style.width = "max-content";
        playericon.type = "button";
        playericon.id = "p" + id.toString();
        //btn.innerText = "Edit";
        playericon.innerHTML = "Select player";
        //playericon.onclick = checking;
        //playericon.addEventListener('click', $scope.checking());
        // var modal = document.getElementById('myModal');
        // // Get the button that opens the modal
        // var btn = playericon;
        // // Get the <span> element that closes the modal
        // var span = document.getElementsByClassName("close")[0];
        // // When the user clicks on the button, open the modal
        // btn.onclick = function() {
        //     modal.style.display = "block";
        //     display(modal,playericon,position);
        // }
        // // When the user clicks on <span> (x), close the modal
        // span.onclick = function() {
        //     modal.style.display = "none";
        // }
        // // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = "none";
        //     }
        // }
        return playericon;
    };

    $scope.addContinueButton = function() {
        // <form  method="post" action="../action_page.php">
        //     <input type="hidden" name="money" value={{curr_money}}>
        //     <input type="hidden" name="gkp" value={{sel_k}}>
        //     <input type="hidden" name="def" value={{sel_d}}>
        //     <input type="hidden" name="mid" value={{sel_m}}>
        //     <input type="hidden" name="for" value={{sel_f}}>
        //     <input type="submit" value="Submit" >
        // </form>
        var divForButton = document.createElement("div");
        divForButton.style.position = "absolute";
        divForButton.style.top = "25%";
        divForButton.style.right = "5%";


        var continueButton = document.createElement("button");
        continueButton.id = "continue";
        continueButton.setAttribute("class","btn btn-success btn-lg disabled");
        continueButton.innerHTML = "Continue";
        continueButton.style.paddingLeft = "25%";
        continueButton.style.paddingRight = "25%";
        continueButton.onclick = function() {
            var form = document.getElementById("submitform");
            form.submit();
        }
        document.body.appendChild(divForButton);
        divForButton.appendChild(continueButton);
    }

    $scope.myscript = function(formation) {
        var ndef,nmid,nfor;
        ndef = formation / 100; ndef = Math.floor(ndef);
        nmid = (formation / 10) % 10; nmid = Math.floor(nmid);
        nfor = formation % 10; nfor = Math.floor(nfor);
        $scope.defenders = ndef;
        $scope.midfielders = nmid;
        $scope.forwards = nfor;
        $scope.curdefenders = 0;
        $scope.curmidfielders = 0;
        $scope.curforwards = 0;
        $scope.curkeepers = 0;

        document.getElementById("playerList").style.display = "block";
        document.getElementById("init-heading").innerHTML = "Choose Your Team";
        document.getElementById("init-heading").style.marginBottom = "2%";
        document.getElementById("selection").remove();

        $scope.addContinueButton();

        document.body.style.backgroundColor = "rgb(100,155,0)";
        document.body.style.backgroundRepeat = "no-repeat";
        document.body.style.backgroundSize = "cover";

        var currTeam = document.createElement("div");
        currTeam.id = "curr";
        currTeam.style.float = 'right';
        currTeam.style.width = '60%';
        document.body.appendChild(currTeam);

        var money_row = $scope.createRow();
        var money_badge = document.createElement("button");
        money_badge.id = "money";
        money_badge.style.size = "2em";
        money_badge.setAttribute("class","btn btn-primary btn-lg");
        money_badge.innerHTML = "Money remaining: $" + $scope.curr_money.toString() + " million";
        money_row.appendChild(money_badge);
        currTeam.appendChild(money_row)

        var t = 0;
        var forwards = [];
        var rowFor = $scope.createRow();
        var i;
        for (i = 0; i < nfor; i++) {
            var newFor = $scope.createPlayerIcon('forward',t);
            t++;
            forwards.push(newFor);
            rowFor.appendChild(newFor);
        }
        currTeam.appendChild(rowFor);

        var midfielders = [];
        var rowMid = $scope.createRow();
        var i;
        for (i = 0; i < nmid; i++) {
            var newMid = $scope.createPlayerIcon('midfielder',t);
            t++;
            forwards.push(newMid);
            rowMid.appendChild(newMid);
        }
        currTeam.appendChild(rowMid);

        var defenders = [];
        var rowDef = $scope.createRow();
        var i;
        for (i = 0; i < ndef; i++) {
            var newDef = $scope.createPlayerIcon('defender',t);
            t++;
            forwards.push(newDef);
            rowDef.appendChild(newDef);
        }
        currTeam.appendChild(rowDef);

        var goalKeeper = [];
        var rowGkp = $scope.createRow();
        var i;
        for (i = 0; i < 1; i++) {
            var newGkp = $scope.createPlayerIcon('goalkeeper',t);
            t++;
            forwards.push(newGkp);
            rowGkp.appendChild(newGkp);
        }
        currTeam.appendChild(rowGkp);
    };


    $scope.reset = function() {
        $scope.sort = {};
        $scope.sort.predicate = '';
        $scope.sort.orders = ['-pinned'];

        $scope.columns = [];
        $scope.search = { };
        $scope.search.position = "ALL";
        $scope.search.minMinutes = 0;
        reportFilter = null;
    };

    $scope.searchFilter = function(p) {

        if (p.pinned) return true;

        if (reportFilter) return reportFilter(p) && formFilter(p);

        return formFilter(p);
    };

    $scope.clearPins = function() {
        _.each($scope.players, function(p) {
            p.pinned = false;
        });

        document.getElementById("p10").innerHTML = "Select player";
        document.getElementById("p9").innerHTML = "Select player";
        document.getElementById("p8").innerHTML = "Select player";
        document.getElementById("p7").innerHTML = "Select player";
        document.getElementById("p6").innerHTML = "Select player";
        document.getElementById("p5").innerHTML = "Select player";
        document.getElementById("p4").innerHTML = "Select player";
        document.getElementById("p3").innerHTML = "Select player";
        document.getElementById("p2").innerHTML = "Select player";
        document.getElementById("p1").innerHTML = "Select player";
        document.getElementById("p0").innerHTML = "Select player";

        $scope.curdefenders = 0;
        $scope.curmidfielders = 0;
        $scope.curforwards = 0;
        $scope.curkeepers = 0;

        $scope.curr_money = 75.0;
        document.getElementById("money").innerHTML = "Money remaining: $" + $scope.curr_money.toPrecision(3).toString() + " million";
    };

    $scope.highlight = function(col) {
        if (!$scope.sort) return '';
        if (!$scope.sort.orders) return '';

        if (_.chain($scope.sort.orders).map(function(c) { return c.replace('-', '').replace('-', '');}).contains(col).value())
        return 'highlight';

        return '';
    };

    $scope.sortByColumn = function(col) {

        if ($scope.sort.predicate == col) col = '-' + col;

        if (col.indexOf('--') > -1) col = col.substring(2, col.length);

        $scope.sort.predicate = col;
        $scope.sort.orders = $.merge(['-pinned'], [col]);

        $scope.columns = ['-pinned'];
        $scope.columns[col] = "highlight";
    };

    $scope.reports = reports;

    $scope.loadReport = function(report) {

        $scope.reset();

        reportFilter = function(p) {
            return report.func(p);
        };

        if (report.sort != undefined) {

            $scope.sort.orders = $.merge(['-pinned'], report.sort);

            $scope.columns = [];
            _.forEach(report.sort, function(c) {
                c = c.replace('-', '');
                $scope.columns[c] = "highlight";  });
            }
        };

        data.getMeta().then(function(resp) {
            $scope.lastUpdated = resp.date;
        });

        data.getJson().then(function(resp) {

            $scope.teams = data.teams(resp);
            $scope.roster = data.roster(resp);
            //$scope.stat = data.stats(resp);
            $scope.allPlayers = data.players(resp);

            $scope.columns = ['web_name', 'team'];

            data.getCleanData($scope.allPlayers, $scope.teams).then(function(items) {
                $scope.players = items;
                //console.log(JSON.stringify($scope.players));
            });



            $scope.reset();
        });

        var formFilter = function(player) {

            // alias
            var s = $scope.search;

            var name = s.web_name == undefined || player.web_name.toUpperCase().indexOf(s.web_name.toUpperCase()) > -1;
            var team = s.team == undefined  || player.team.short_name.indexOf(s.team.short_name.toUpperCase()) > -1;
            var minutes = s.minMinutes == undefined || s.minMinutes < 0 || (player.minutes >= s.minMinutes);

            var position = s.position == "ALL" ? '' : s.position.toUpperCase();
            var posn = position == '' || position == player.position;

            return name && team && minutes && posn;
        };

}]);
