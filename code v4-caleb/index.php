<?php
error_reporting(0); // Matikan semua error
ini_set('display_errors', 0);
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: login.php");
    exit();
}
include 'profileAdd.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Home</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="logo">
          <img src="Assets/patribera-logo.png" alt="Logo" />
        </div>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="pageKelompok.php">Kelompok</a></li>
          <li><a href="tugas.php">Tugas</a></li>
        </ul>
        <div class="profile">
          <a href="profile.php"><img src="<?php echo $profile_image; ?>" alt="Profile" width="65" height="65" style="border-radius: 50%;">
        </a>
        </div>
      </nav>
    </header>

    <main>
      <!-- banner -->
      <section class="container-banner">
        <img
          src="Assets/Green Tosca Modern Geometric Web Hosting Service Presentation (4) 1.png"
          alt=""
          class="banner"
        />
      </section>

      <section class="about">
        <div class="background-hijau">
          <div class="container">
            <div class="image">
              <img
                alt=""
                height="300"
                src="Assets/apa-patribera.png"
                width="450"
              />
            </div>
            <div class="content">
              <h1 id="animated-title">
                Apa Itu
                <span> PATRIBERA </span>
                ?
              </h1>
              <p id="animated-paragraph">
              Patribera (Pengenalan Kehidupan Kampus bagi Mahasiswa Baru), 
              di UPN Veteran Jakarta adalah sebuah acara tahunan yang dirancang 
              untuk menyambut mahasiswa baru dan memperkenalkan mereka pada kehidupan kampus. 
              Pada tahun 2024, acara ini melibatkan lebih dari 200 panitia mahasiswa yang bersemangat, 
              dan berlangsung pada 12-13 Agustus di Tennis Indoor Senayan, Jakarta​
              </p>
            </div>
            
      </section>
      <!-- rangkaian -->
      <section class="container-rangkaian">
        <div class="card">
          <div class="header">
            <h1>MENTORING SESSION</h1>
            <div class="date">20 Juni 2024 - 30 Juni 2024</div>
          </div>
          <div class="image-container">
            <img
              alt="Screenshot of a virtual meeting with multiple participants"
              height="200"
              src="Assets/mentoring.png"
              width="400"
            />
          </div>
          <div class="content-rangkaian">
            <p>
            Dalam kegiatan mentoring saat ospek, 
            mentor berperan untuk membimbing mahasiswa 
            baru agar lebih mudah beradaptasi dengan kehidupan kampus. 
            Mentor memberikan penjelasan tentang budaya kampus, 
            kegiatan organisasi, serta membantu mahasiswa baru memahami harapan 
            dan tantangan yang mereka hadapi.
            </p>
          </div>
        </div>
        <div class="card">
          <div class="header">
            <h1>PATRIBERA DAY 1 & 2</h1>
            <div class="date">1 Juli 2024 - 1 Juli 2024</div>
          </div>
          <div class="image-container">
            <img
              alt="Screenshot of a virtual meeting with multiple participants"
              height="200"
              src="Assets/patriberaday.svg"
              width="400"
            />
          </div>
          <div class="content-rangkaian">
            <p>
            Kegiatan lainnya meliputi sesi motivasi, pengenalan organisasi mahasiswa, 
            serta berbagai unit kegiatan kampus (UKM) yang membantu mahasiswa mengenal 
            lebih dekat aktivitas ekstrakurikuler di kampus. Ada juga kegiatan mentoring, 
            di mana mahasiswa baru dibimbing oleh senior untuk memahami tata tertib kampus, 
            sistem akademik, dan kehidupan sosial. Penutupan acara 
            sering kali dirayakan dengan pertunjukan seni atau momen kebersamaan yang menandai 
            awal perjalanan mahasiswa di UPNVJ
            </p>
          </div>
        </div>

        <div class="card">
          <div class="header">
            <h1>UKM EXPO</h1>
            <div class="date">22 Juli 2024</div>
          </div>
          <div class="image-container">
            <img
              alt="Screenshot of a virtual meeting with multiple participants"
              height="200"
              src="Assets/ukm.svg"
              width="400"
            />
          </div>
          <div class="content-rangkaian">
            <p>
            UKM Expo adalah kegiatan tahunan di UPN Veteran Jakarta yang bertujuan 
            untuk mempromosikan dan memperkenalkan Unit Kegiatan Mahasiswa (UKM) 
            kepada mahasiswa baru. Acara ini menjadi wadah bagi setiap UKM untuk 
            memamerkan program, kegiatan, dan pencapaian mereka melalui berbagai 
            bentuk presentasi menarik, seperti pameran stand, pertunjukan seni, 
            hingga demonstrasi langsung. 
            </p>
          </div>
        </div>
      </section>
      
      <div class="abstract-section"></div>
      <!-- info -->
      <section class="info">
        <div class="container-info">
          <div class="info-box">
            <h1>INFORMASI LEBIH LANJUT TENTANG</h1>
            <h2>PATRIBERA</h2>
            <a href="https://bit.ly/m/INFO-PATRIBERA-2024" target="_blank" class="button">KLIK DISINI</a>
          </div>
          <div class="image-box">
            <img src="Assets/info.png" alt="Patribera Info" />
          </div>
        </div>
      </section>
      <!-- faq -->



<!-- FAQ Section -->
<section class="background-faq">
  <div class="title">Frequently Asked <span>Questions</span></div>
  <div class="faq">
    <div class="container-faq">
      <div class="faq-item">
        <div class="question">
          <p><strong>Apakah OSPEK wajib diikuti oleh semua mahasiswa baru?</strong></p>
          <div class="icon">
            <img src="Assets/arrow.png" alt="arrow" />
          </div>
        </div>
        <p class="answer">
          Ya, OSPEK biasanya merupakan kegiatan wajib bagi seluruh mahasiswa baru karena merupakan bagian dari pengenalan lingkungan kampus, budaya akademik, dan tata tertib di kampus. Absensi selama kegiatan juga akan diperhitungkan.
        </p>
      </div>

      <div class="faq-item">
        <div class="question">
          <p><strong>Apa saja yang harus dibawa saat OSPEK?</strong></p>
          <div class="icon">
            <img src="Assets/arrow.png" alt="arrow" />
          </div>
        </div>
        <p class="answer">
        Saat OSPEK, mahasiswa baru biasanya perlu membawa beberapa perlengkapan 
        wajib yang sudah ditentukan oleh panitia. Umumnya, barang yang perlu 
        disiapkan meliputi pakaian sesuai dress code yang ditentukan 
        (seperti kemeja putih dan celana hitam), alat tulis, serta dokumen 
        penting seperti identitas diri atau kartu peserta. Pastikan untuk 
        membaca panduan dari panitia dengan teliti agar tidak ada barang yang terlewatkan.
      </p>
      </div>

      <div class="faq-item">
        <div class="question">
          <p><strong>Dimana lokasi pelaksanaan PATRIBERA 2024?</strong></p>
          <div class="icon">
            <img src="Assets/arrow.png" alt="arrow" />
          </div>
        </div>
        <p class="answer">
        Acara ini diselenggarakan di Tennis Indoor Senayan dengan jadwal padat dari pukul 06.00 hingga 17.30        </p>
      </div>

      <div class="faq-item">
        <div class="question">
          <p><strong>Bagaimana Peraturan dan Ketentuan untuk Kegiatan OSPEK ini?</strong></p>
          <div class="icon">
            <img src="Assets/arrow.png" alt="arrow" />
          </div>
        </div>
        <p class="answer">
Untuk Informasi yang lebih lengkap, bisa membaca panduan yang ada di webiste ini ya!
Atau bisa tanyakan ke mentor kamu, Jangan Ragu Untuk Bertanya YA!        </p>
      </div>
    </div>
  </div>
</section>
      </div>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <div class="footer-content">
        <div class="footer-logo">
          <img src="Assets/patribera-logo.png" alt="Logo" />
          <div class="footer-info">
            <h1>SIERA</h1>
            <p>Sistem Informasi PATRIBERA</p>
          </div>
        </div>
        <div class="footer-links">
          <div class="footer-pages">
            <h3>Pages</h3>
            <ul>
              <li>Home</li>
              <li>Kelompok</li>
              <li>Tugas</li>
              <li>Profile</li>
            </ul>
          </div>
          <div class="footer-contact">
            <h3>Contact Us</h3>
            <ul>
              <li>
                <img src="Assets/call.png" alt="Phone" /> 081234567899 (chat only)
              </li>
              <li>
                <img src="Assets/mesages.png" alt="Email" />
                PATRIBERAUPNVJ@gmail.com
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>
          Copyright © Kelompok 7. Made at FIK UPNVJ for Praktikum Pemrograman
          Web
        </p>
      </div>
    </footer>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        let text = document.querySelector(".info-box h1");
        let textContent = text.textContent;
        let i = 0;
        text.textContent = ""; // Clear initial text
    
        function typeWriter() {
          if (i < textContent.length) {
            text.textContent += textContent.charAt(i);
            i++;
            setTimeout(typeWriter, 250); // Speed of typing
          }
        }
    
        // Call the function to start the typewriter effect
        typeWriter();
      });
      document.addEventListener("DOMContentLoaded", function() {
  const titleSpan = document.querySelector('#animated-title span');
  const paragraph = document.querySelector('#animated-paragraph');

  // Typing effect for title span
  function typeEffect(element, delay) {
    const text = element.textContent;
    element.textContent = ''; // Clear text first
    element.style.opacity = '1'; // Ensure opacity is set to visible
    let i = 0;
    const speed = 300; // Typing speed in milliseconds
    const typingInterval = setInterval(() => {
      if (i < text.length) {
        element.textContent += text.charAt(i);
        i++;
      } else {
        clearInterval(typingInterval);
      }
    }, speed);
  }
  document.addEventListener('DOMContentLoaded', () => {
    const abstractSection = document.createElement('div');
    abstractSection.className = 'abstract-section';
    
    // Insert the abstract section between rangkaian and info sections
    const rangkaianSection = document.querySelector('.container-rangkaian');
    const infoSection = document.querySelector('.info');
    rangkaianSection.parentNode.insertBefore(abstractSection, infoSection);

    // Shape configurations
    const shapeTypes = [
        { type: 'circle', size: [50, 100], animations: ['float', 'rotate'] },
        { type: 'triangle', size: [50, 100], animations: ['moveHorizontal'] },
        { type: 'rectangle', size: [80, 40], animations: ['float'] }
    ];

    // Create multiple shapes
    for (let i = 0; i < 6; i++) {
        const shapeConfig = shapeTypes[Math.floor(Math.random() * shapeTypes.length)];
        const shape = document.createElement('div');
        shape.classList.add('shape', shapeConfig.type);
        
        const size = shapeConfig.size[Math.floor(Math.random() * shapeConfig.size.length)];
        shape.style.width = `${size}px`;
        shape.style.height = `${size}px`;
        
        // Random positioning
        shape.style.top = `${Math.random() * 100}%`;
        shape.style.left = `${Math.random() * 100}%`;
        
        // Random animation
        const animation = shapeConfig.animations[Math.floor(Math.random() * shapeConfig.animations.length)];
        shape.style.animation = `${animation} 3s ease-in-out infinite`;
        
        abstractSection.appendChild(shape);
    }
});
  // Fade-in effect for paragraph
  function fadeInText(element, delay) {
    setTimeout(() => {
      element.classList.add('fade-in-active');
    }, delay);
  }

  // Start typing effect for title span after small delay
  setTimeout(() => {
    typeEffect(titleSpan, 0);
    fadeInText(paragraph, 2500); // Delay paragraph fade-in until typing is done
  }, 500);
});
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua item FAQ
    const faqItems = document.querySelectorAll(".faq-item");

    // Tambahkan event listener ke setiap item FAQ
    faqItems.forEach(item => {
      const answer = item.querySelector(".answer"); // Temukan elemen jawaban
      const icon = item.querySelector(".icon img"); // Temukan elemen ikon (panah)
      
      item.addEventListener("click", function () {
        // Jika sudah expanded, tutup
        const isExpanded = item.classList.contains("expanded");

        // Tutup semua FAQ lainnya terlebih dahulu
        faqItems.forEach(i => {
          i.classList.remove("expanded");
          i.querySelector(".answer").style.display = "none"; // Sembunyikan semua jawaban
          i.querySelector(".icon img").style.transform = "rotate(0deg)"; // Kembalikan rotasi ikon
        });

        // Jika item belum expanded, buka
        if (!isExpanded) {
          item.classList.add("expanded");
          answer.style.display = "block"; // Tampilkan jawaban
          icon.style.transform = "rotate(180deg)"; // Rotasi ikon 180 derajat
        }
      });
    });
  });
    </script>
    
  </body>
</html>
