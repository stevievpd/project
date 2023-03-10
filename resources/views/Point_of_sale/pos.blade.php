<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Reality POS</title>

    <link rel="stylesheet" href="/css/pos/style.pos.css">
</head>

<body>
    <header>
        <div class="content">
            <a href="/employee" style="text-decoration: none;" > <h1>THE<span>REALITY</span>POS</h1></a>
            <h2>COMING SOON</h2>
            <div class="countdown">00 : 00 : 00 : 00</div>
        </div>
    </header>
    <script>
        // Setup End Date for Countdown (getTime == Time in Milleseconds)
        let launchDate = new Date("Feb 07, 2023 12:00:00").getTime();

        // Setup Timer to tick every 1 second
        let timer = setInterval(tick, 1000);

        function tick() {
            // Get current time
            let now = new Date().getTime();
            // Get the difference in time to get time left until reaches 0
            let t = launchDate - now;

            // Check if time is above 0
            if (t > 0) {
                // Setup Days, hours, seconds and minutes
                // Algorithm to calculate days...
                let days = Math.floor(t / (1000 * 60 * 60 * 24));
                // prefix any number below 10 with a "0" E.g. 1 = 01
                if (days < 10) {
                    days = "0" + days;
                }

                // Algorithm to calculate hours
                let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                if (hours < 10) {
                    hours = "0" + hours;
                }

                // Algorithm to calculate minutes
                let mins = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                if (mins < 10) {
                    mins = "0" + mins;
                }

                // Algorithm to calc seconds
                let secs = Math.floor((t % (1000 * 60)) / 1000);
                if (secs < 10) {
                    secs = "0" + secs;
                }

                // Create Time String
                let time = `${days} : ${hours} : ${mins} : ${secs}`;

                // Set time on document
                document.querySelector('.countdown').innerText = time;
            }
        }
    </script>
</body>

</html>
