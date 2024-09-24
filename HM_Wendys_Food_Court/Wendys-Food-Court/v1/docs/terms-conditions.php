<?php
    include '../layouts/header.php';
?>

<head>
    <style>
        ol {
            counter-reset: item;
        }

        li {
            display: block;
            text-align: justify;
        }

        li:before {
            content: counters(item, ".") " ";
            counter-increment: item;
            color: red;
        }

        ol li ol li:before {
            color: rebeccapurple;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="alert-dark p-5 text-center fs-1 text-primary fw-bold">Terms & Conditions</div>
        <ol>
            <li class="fw-bold p-4"><span class="text-danger">Applicability</span>
                <ol>
                    <li>The General Terms and Conditions below apply to all offers and transactions of Wendys foodcourt.
                        Prices are subject to change.</li>
                    <li>By accepting an offer or making an order, the consumer expressly accepts the applicability of
                        these General Terms and Conditions.</li>
                    <li>Deviations from that stipulated in these Terms and Conditions are only valid when they are
                        confirmed in writing by the management.</li>
                    <li>All rights and entitlements stipulated for Wendys foodcourt in these General Terms and
                        Conditions and
                        any further agreements will also apply for intermediaries and other third parties deployed by
                        Wendys foodcourt.</li>
                </ol>
            </li>

            <li class="fw-bold p-4"><span class="text-danger">Quality</span>
                <ol>
                    <li>The restaurant guarantees that all the products offered meet the standards of the concept.</li>
                    <li>If there are any complaints the management needs to be informed immediately. Appropriate actions
                        will be taken as soon as possible.</li>
                </ol>
            </li>

            <li class="fw-bold p-4"><span class="text-danger">Prices/offers</span>
                <ol>
                    <li>All offers made by Wendys foodcourt are without obligation and Wendys foodcourt expressly
                        reserves the
                        right to change the prices, in particular if this is necessary as a result of statutory or other
                        regulations.</li>
                    <li>All prices are indicated in euros, including VAT.</li>
                    <li>In certain cases, promotional prices apply. These prices are valid only during a specific period
                        as long as stocks last. No entitlement to these prices may be invoked before or after the
                        specific period.</li>
                    <li>Wendys foodcourt cannot be held to any price indications that are clearly incorrect, for example
                        as a
                        result of obvious typesetting or printing errors. No rights may be derived from incorrect price
                        information.</li>
                </ol>
            </li>

            <li class="fw-bold p-4"><span class="text-danger">Cancellations</span>
                <ol>
                    <li>Wendys foodcourt is entitled to cancel or change the date of an event. Should this happen, Blue
                        Pepper will attempt to provide a suitable solution. If an event is cancelled or postponed, Blue
                        Pepper will do its utmost to inform you as soon as possible. However, Wendys foodcourt cannot
                        guarantee it is possible to inform you timely of any change or cancellation of an event or be
                        held responsible for refunds, compensations or for any resulting costs you may incur, for
                        example for travel, accommodation and/or any other related goods or service.</li>
                    <li>Before confirming your reservation, always check carefully that you have reserved the correct
                        (number of) persons. Wrongfully ordered (numbers of) persons are not refundable.</li>
                    <li>All purchases are final. The dinner cruise tickets bought here cannot be returned for any
                        refunds whatsoever; group bookings paid for on the website likewise cannot be cancelled by the
                        purchaser and refunds claimed for any reason whatsoever.</li>
                </ol>
            </li>

            <li class="fw-bold p-4"><span class="text-danger">Payment</span>
                <ol>
                    <li>Methods of payment we accept: Cash, Visa, Mastercard, BKash, Rocket, and Nagad.</li>
                    <li>You will not receive confirmation of your definitive booking until your payment has been
                        approved.</li>
                </ol>
            </li>

            <li class="fw-bold p-4"><span class="text-danger">Other provisions</span>
                <ol>
                    <li>If one or more of the provisions in these Terms and Conditions or any other agreement with Blue
                        Pepper are in conflict with any applicable legal regulation, the provision in question will
                        lapse and be replaced by a new comparable stipulation admissible by law to be determined by Blue
                        Pepper.</li>
                    <li>The law of the Netherlands applies to all agreements entered into with or concluded by Blue
                        Pepper. Any disputes arising directly or indirectly from these agreements will be exclusively
                        settled by the Court of Amsterdam.</li>
                </ol>
            </li>
    </div>

    <?php
        include '../layouts/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>