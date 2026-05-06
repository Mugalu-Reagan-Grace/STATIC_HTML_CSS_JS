<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fees Structure - <?= SCHOOL_NAME_UPPER ?></title>
  <meta
    name="description"
    content="View the comprehensive fees structure and payment information for <?= SCHOOL_NAME_UPPER ?>. Transparent and affordable education." />
  <link
    rel="icon"
    type="image/x-icon"
    href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico" />
  <link rel="stylesheet" href="calyst.css" />
  <link rel="stylesheet" href="./ASSETS/fonts/fontawesome/css/solid.css" />
  <link
    rel="stylesheet"
    href="./ASSETS/fonts/fontawesome/css/fontawesome.css" />
</head>

<body class="fees-page">
  <?php include_once 'components/header.php'; ?>

  <!-- Main Content -->
  <main>
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">School fees</span>
        <h1>Fees Structure</h1>
        <p>
          Transparent and comprehensive information about tuition and fees at
          <?= SCHOOL_NAME_UPPER ?>
        </p>
      </div>
    </section>

    <section class="section photo-showcase">
      <div class="container">
        <div class="section-title">
          <h2>Investing in Every Learner</h2>
          <p>
            Supportive classrooms, vibrant activities, and bright futures.
          </p>
        </div>
      </div>
      </div>
    </section>

    <section class="fees-container">
      <div class="container">
        <!-- Introduction -->
        <div class="fees-intro">
          <h2>School Fees 2026</h2>
          <p>
            At <?= SCHOOL_NAME_UPPER ?>, we are committed to providing quality
            education at reasonable rates. Our fees structure is transparent
            and designed to accommodate families. Payment is due at the
            beginning of each term.
          </p>
        </div>

        <!-- Main Tuition Fees -->
        <div class="fees-section">
          <h2>
            <i class="fa-solid fa-graduation-cap"></i> School Tuition Fees
          </h2>
          <div class="fees-table-wrapper">
            <table class="fees-table">
              <thead>
                <tr>
                  <th>Program</th>
                  <th>Term I</th>
                  <th>Term II</th>
                  <th>Term III</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="grade-cell">Half Day</td>
                  <td>500,000/-</td>
                  <td>500,000/-</td>
                  <td>500,000/-</td>
                </tr>
                <tr>
                  <td class="grade-cell">Full Day</td>
                  <td>600,000/-</td>
                  <td>600,000/-</td>
                  <td>600,000/-</td>
                </tr>
              </tbody>
            </table>
          </div>
          <p
            style="
                margin-top: 20px;
                padding: 15px;
                background: rgba(30, 58, 138, 0.95);
                border-radius: 8px;
                color: #ffffff;
              ">
            <strong>Note:</strong> Admission fee for new students:
            <strong>30,000/-</strong> (One-time payment)
          </p>
        </div>

        <!-- Additional Fees -->
        <div class="fees-section">
          <h2>
            <i class="fa-solid fa-list-check"></i> Additional Compulsory Fees
          </h2>
          <div class="fees-table-wrapper">
            <table class="fees-table">
              <thead>
                <tr>
                  <th>Fee Description</th>
                  <th>Term I</th>
                  <th>Term II</th>
                  <th>Term III</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Swimming Fees</td>
                  <td>60,000/-</td>
                  <td>60,000/-</td>
                  <td>60,000/-</td>
                </tr>
                <tr>
                  <td>Requirements (if not brought in kind)</td>
                  <td>50,000/-</td>
                  <td>50,000/-</td>
                  <td>50,000/-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- School Uniforms -->
        <div class="fees-section">
          <h2><i class="fa-solid fa-shirt"></i> School Uniforms</h2>

          <!-- Boys Nursery -->
          <div class="uniform-category">
            <h3>Boys Uniform (Nursery)</h3>
            <div class="uniform-items">
              <div class="uniform-item">
                <span>Complete Set</span>
                <span class="price">185,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 shirts</span>
                <span class="price">40,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 shorts</span>
                <span class="price">30,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 pairs of socks</span>
                <span class="price">20,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 P.E uniform</span>
                <span class="price">40,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 sweater</span>
                <span class="price">30,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 belt</span>
                <span class="price">10,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 bib</span>
                <span class="price">15,000/-</span>
              </div>
            </div>
          </div>

          <!-- Girls Nursery -->
          <div class="uniform-category">
            <h3>Girls Uniform (Nursery)</h3>
            <div class="uniform-items">
              <div class="uniform-item">
                <span>Complete Set</span>
                <span class="price">165,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 dresses</span>
                <span class="price">60,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 pairs of socks</span>
                <span class="price">20,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 sweater</span>
                <span class="price">30,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 P.E uniform</span>
                <span class="price">40,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 bib</span>
                <span class="price">15,000/-</span>
              </div>
            </div>
          </div>

          <!-- Boys Primary -->
          <div class="uniform-category">
            <h3>Boys Uniform (Primary)</h3>
            <div class="uniform-items">
              <div class="uniform-item">
                <span>Complete Set</span>
                <span class="price">215,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 shirts</span>
                <span class="price">50,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 shorts</span>
                <span class="price">40,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 pairs of socks</span>
                <span class="price">20,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 P.E uniform</span>
                <span class="price">45,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 sweater</span>
                <span class="price">35,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 belt</span>
                <span class="price">10,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 bib</span>
                <span class="price">15,000/-</span>
              </div>
            </div>
          </div>

          <!-- Girls Primary -->
          <div class="uniform-category">
            <h3>Girls Uniform (Primary)</h3>
            <div class="uniform-items">
              <div class="uniform-item">
                <span>Complete Set</span>
                <span class="price">185,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 dresses</span>
                <span class="price">70,000/-</span>
              </div>
              <div class="uniform-item">
                <span>2 pairs of socks</span>
                <span class="price">20,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 sweater</span>
                <span class="price">35,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 P.E Uniform</span>
                <span class="price">45,000/-</span>
              </div>
              <div class="uniform-item">
                <span>1 bib</span>
                <span class="price">15,000/-</span>
              </div>
            </div>
          </div>

          <!-- Soccer Jersey -->
          <div class="uniform-category">
            <h3>Soccer Jersey</h3>
            <div class="uniform-items">
              <div class="uniform-item">
                <span>Soccer Jersey</span>
                <span class="price">35,000/-</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Plans -->
        <div class="fees-section">
          <h2>
            <i class="fa-solid fa-credit-card"></i> Payment Plans & Options
          </h2>
          <div class="payment-plans-grid">
            <div class="payment-plan-card">
              <div class="plan-icon">
                <i class="fa-solid fa-calendar-days"></i>
              </div>
              <h3>Termly Payment</h3>
              <p class="plan-amount">3 installments per year</p>
              <p class="plan-details">
                Payment divided into three terms: January, May, and September.
                Due within 2 weeks of term commencement.
              </p>
              <p class="plan-note">
                <strong>Discount:</strong> 2% if paid in full before term
                starts
              </p>
            </div>

            <div class="payment-plan-card">
              <div class="plan-icon">
                <i class="fa-solid fa-calendar"></i>
              </div>
              <h3>Monthly Payment</h3>
              <p class="plan-amount">12 installments per year</p>
              <p class="plan-details">
                Spread payments across all 12 months for easier cash flow
                management. Ideal for working parents.
              </p>
              <p class="plan-note">
                <strong>Administration Fee:</strong> ₦1,000 per month
              </p>
            </div>

            <div class="payment-plan-card">
              <div class="plan-icon">
                <i class="fa-solid fa-wallet"></i>
              </div>
              <h3>Full Payment</h3>
              <p class="plan-amount">One annual payment</p>
              <p class="plan-details">
                Pay full year tuition upfront before the school year begins.
                Ideal for families with available funds.
              </p>
              <p class="plan-note">
                <strong>Discount:</strong> 5% discount on total fees
              </p>
            </div>

            <div class="payment-plan-card">
              <div class="plan-icon">
                <i class="fa-solid fa-handshake-angle"></i>
              </div>
              <h3>Financial Assistance</h3>
              <p class="plan-amount">Scholarships & Sponsorships</p>
              <p class="plan-details">
                Merit-based and need-based scholarships available. Contact the
                admissions office for details and application process.
              </p>
              <p class="plan-note">
                <strong>Availability:</strong> Limited slots available
              </p>
            </div>
          </div>
        </div>

        <!-- Refund Policy -->
        <div class="fees-section">
          <h2><i class="fa-solid fa-undo"></i> Refund & Withdrawal Policy</h2>
          <div class="policy-cards">
            <div class="policy-card">
              <h3>Early Withdrawal</h3>
              <ul>
                <li>
                  <strong>Before End of Term 1:</strong> 80% refund of annual
                  fees (minus registration & development fees)
                </li>
                <li>
                  <strong>Before End of Term 2:</strong> 50% refund of
                  remaining fees
                </li>
                <li>
                  <strong>Before End of Term 3:</strong> No refund; full year
                  fees are due
                </li>
              </ul>
            </div>

            <div class="policy-card">
              <h3>Important Notes</h3>
              <ul>
                <li>
                  Written notice of withdrawal must be submitted to the
                  Principal at least 2 weeks in advance
                </li>
                <li>
                  All school properties must be returned before refund
                  processing
                </li>
                <li>
                  Outstanding fees and penalties will be deducted from refunds
                </li>
                <li>
                  Non-refundable fees include registration, development levy,
                  and examination fees
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Other Requirements -->
        <div class="fees-section">
          <h2><i class="fa-solid fa-list"></i> Other Requirements</h2>
          <p style="margin-bottom: 20px; color: #475569">
            The following items are required to be provided by parents:
          </p>
          <div class="requirements-list">
            <ul>
              <li>1 ream of photocopying papers (Double A)</li>
              <li>2 packets Wet wipes (500gm)</li>
              <li>6 toilet paper rolls (big size)</li>
              <li>Crayons - 1 packet (Baby Class only)</li>
              <li>Pencils – 1 dozen Nataraj (Middle Class to P.2 only)</li>
              <li>Blue pens – 1 dozen Nataraj (P.4 only)</li>
            </ul>
          </div>
          <p
            style="
                margin-top: 20px;
                padding: 15px;
                background: rgba(30, 58, 138, 0.95);
                border-radius: 8px;
                color: #ffffff;
              ">
            <strong>Note:</strong> These items help provide a complete
            learning environment for your child and support classroom
            activities.
          </p>
        </div>

        <!-- Payment Methods -->
        <div class="fees-section">
          <h2>
            <i class="fa-solid fa-building-columns"></i> Payment Methods
          </h2>
          <div class="payment-methods-grid">
            <div class="payment-method-card">
              <div class="method-icon">
                <i class="fa-solid fa-bank"></i>
              </div>
              <h3>Bank Transfer</h3>
              <p>Direct transfer to school account</p>
              <p class="payment-note">Contact office for account details</p>
            </div>

            <div class="payment-method-card">
              <div class="method-icon">
                <i class="fa-solid fa-money-check-dollar"></i>
              </div>
              <h3>Cheque Payment</h3>
              <p>Post-dated or immediate cheques</p>
              <p class="payment-note">
                Made payable to <?= SCHOOL_NAME_UPPER ?>
              </p>
            </div>

            <div class="payment-method-card">
              <div class="method-icon">
                <i class="fa-solid fa-cash"></i>
              </div>
              <h3>Cash Payment</h3>
              <p>Direct payment at school office</p>
              <p class="payment-note">Receipt issued immediately</p>
            </div>

            <div class="payment-method-card">
              <div class="method-icon">
                <i class="fa-solid fa-mobile"></i>
              </div>
              <h3>Online Payment</h3>
              <p>E-transfer and mobile money</p>
              <p class="payment-note">Quick and secure processing</p>
            </div>
          </div>
        </div>

        <!-- Contact & Inquiries -->
        <div class="fees-section fees-contact">
          <h2>Have Questions About Fees?</h2>
          <p>
            Our admissions and accounts team is ready to assist you with any
            inquiries regarding fees, payment plans, or financial assistance.
          </p>
          <div class="contact-info">
            <div class="info-item">
              <i class="fa-solid fa-envelope"></i>
              <div>
                <h4>Email</h4>
                <a href="mailto:mugalureagan18@gmail.com">mugalureagan18@gmail.com</a>
              </div>
            </div>
            <div class="info-item">
              <i class="fa-solid fa-phone"></i>
              <div>
                <h4>Phone</h4>
                <a href="tel:+256774744394">(+256) 774-744-394</a><br />
                <a href="tel:+256752482066">(+256) 752-482-066</a>
              </div>
            </div>
            <div class="info-item">
              <i class="fa-solid fa-location-dot"></i>
              <div>
                <h4>Visit Us</h4>
                <p>P.O.BOX 124666<br />Kampala, Uganda</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <?php include_once 'components/footer.php'; ?>

  <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
</body>

</html>


