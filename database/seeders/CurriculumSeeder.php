<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use App\Models\Subject;
use App\Models\SubjectDocument;
use App\Models\SubjectTopic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ─── 1. Grade Levels ───
        $grades = [
            [
                'name' => 'Kelas 10',
                'slug' => 'kelas-10',
                'phase' => 'Fase E',
                'level_number' => 10,
                'badge_text' => 'Fondasi Kejuruan & Karakter',
                'description' => 'Tahap pengenalan dasar kejuruan SMK, literasi digital, algoritma dasar, logika komputasi, dan penguatan mata pelajaran umum sesuai standar Kurikulum Merdeka.',
                'order' => 1,
            ],
            [
                'name' => 'Kelas 11',
                'slug' => 'kelas-11',
                'phase' => 'Fase F',
                'level_number' => 11,
                'badge_text' => 'Pendalaman Konsentrasi Keahlian',
                'description' => 'Fokus pada pendalaman keahlian spesifik rekayasa perangkat lunak (PPLG/RPL), pemrograman berorientasi objek, perancangan database relasional, dan arsitektur aplikasi modern.',
                'order' => 2,
            ],
            [
                'name' => 'Kelas 12',
                'slug' => 'kelas-12',
                'phase' => 'Fase F',
                'level_number' => 12,
                'badge_text' => 'Spesialisasi & Kesiapan Industri',
                'description' => 'Pengembangan proyek digital terintegrasi skala industri, arsitektur cloud, keamanan sistem siber, kewirausahaan berbasis teknologi (PKK), serta persiapan uji sertifikasi profesi (LSP).',
                'order' => 3,
            ],
        ];

        foreach ($grades as $gradeData) {
            $grade = GradeLevel::updateOrCreate(
                ['slug' => $gradeData['slug']],
                $gradeData
            );

            // Populate subjects based on grade
            if ($grade->slug === 'kelas-10') {
                $this->seedKelas10($grade);
            } elseif ($grade->slug === 'kelas-11') {
                $this->seedKelas11($grade);
            } elseif ($grade->slug === 'kelas-12') {
                $this->seedKelas12($grade);
            }
        }
    }

    protected function seedKelas10(GradeLevel $grade): void
    {
        $subjects = [
            // Kejuruan
            [
                'name' => 'Dasar-Dasar Pengembangan Perangkat Lunak & Gim (PPLG)',
                'slug' => 'dasar-dasar-pplg',
                'code' => 'PPLG-101',
                'category' => 'kejuruan',
                'vocational_stream' => 'Pengembangan Perangkat Lunak & Gim',
                'description' => 'Mempelajari proses bisnis industri perangkat lunak, K3LH lingkungan kerja digital, logika pemrograman terstruktur, algoritma dasar (pseudocode & flowchart), serta pengenalan web dasar (HTML5/CSS3).',
                'semester' => 'Semester 1 & 2',
                'total_hours' => 144,
                'icon' => 'code',
                'color' => 'brand',
                'order' => 1,
                'topics' => [
                    [
                        'title' => 'Bab 1: Proses Bisnis & Ekosistem Industri Rekayasa Perangkat Lunak',
                        'chapter_number' => 1,
                        'summary' => 'Membahas rantai nilai dan alur kerja di industri perangkat lunak, mulai dari fase requirement gathering, design thinking, SDLC (Software Development Life Cycle), hingga deployment dan continuous maintenance.',
                        'key_points' => [
                            'Memahami siklus hidup pengembangan sistem (SDLC) mulai waterfall hingga agile',
                            'Peran profesional: Frontend, Backend, UI/UX Designer, QA Engineer, dan Product Manager',
                            'Standar Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH) dalam ergonomi kerja pemrograman',
                        ],
                        'estimated_minutes' => 25,
                        'ai_prompt_suggestion' => 'Jelaskan perbedaan mendasar antara model SDLC Waterfall dan Agile Scrum dalam konteks proyek perangkat lunak SMK.',
                        'documents' => [
                            [
                                'title' => 'Modul Ajar 01: Ekosistem Industri Software & SDLC',
                                'description' => 'Bahan ajar lengkap pengenalan profesi IT, regulasi hak cipta perangkat lunak, dan tahapan SDLC.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '3.4 MB',
                                'download_count' => 342,
                                'is_featured' => true,
                            ],
                            [
                                'title' => 'Jobsheet Praktikum 01: Analisis Kebutuhan Sistem & User Persona',
                                'description' => 'Panduan praktik menyusun dokumen System Requirement Specification (SRS) sederhana.',
                                'document_type' => 'jobsheet',
                                'file_format' => 'PDF',
                                'file_size' => '1.8 MB',
                                'download_count' => 215,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Bab 2: Logika Komputasional & Perancangan Algoritma Terstruktur',
                        'chapter_number' => 2,
                        'summary' => 'Dasar pemecahan masalah (problem solving) dengan logika algoritma, notasi deskriptif, diagram alir (flowchart standar ANSI), pseudocode, dan dasar percabangan serta perulangan logis.',
                        'key_points' => [
                            'Empat pilar computational thinking: dekomposisi, pengenalan pola, abstraksi, dan algoritma',
                            'Simbol standar flowchart dan penggunaannya dalam visualisasi alur program',
                            'Konstruksi algoritma: sekuensial (runtunan), percabangan (if-else, switch), dan pengulangan (for, while, do-while)',
                        ],
                        'estimated_minutes' => 35,
                        'ai_prompt_suggestion' => 'Berikan contoh algoritma pengurutan (sorting) bubble sort beserta flowchart dan pseudocode yang mudah dipahami.',
                        'documents' => [
                            [
                                'title' => 'Buku Panduan Algoritma & Flowchart Pemrograman',
                                'description' => 'Modul komprehensif flowchart standar industri dengan studi kasus logika komputasi.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '4.8 MB',
                                'download_count' => 512,
                                'is_featured' => true,
                            ],
                            [
                                'title' => 'Slide Presentasi: Notasi Algoritma & Pseudocode',
                                'description' => 'Slide tayang untuk materi pembelajaran interaktif di kelas.',
                                'document_type' => 'slide',
                                'file_format' => 'PPTX',
                                'file_size' => '6.2 MB',
                                'download_count' => 189,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Bab 3: Fondasi Web Frontend (Semantic HTML5 & Modern CSS3)',
                        'chapter_number' => 3,
                        'summary' => 'Membangun antarmuka web modern pertama menggunakan elemen semantik HTML5, tipografi web, tata letak modern Flexbox dan Grid System, serta prinsip responsive mobile-first design.',
                        'key_points' => [
                            'Struktur semantik HTML5: header, nav, main, article, section, footer, dan aksesibilitas',
                            'Box Model CSS: margin, border, padding, content box vs border box',
                            'Desain adaptif mobile-first menggunakan CSS Flexbox dan media queries',
                        ],
                        'estimated_minutes' => 40,
                        'ai_prompt_suggestion' => 'Bagaimana cara membuat layout navigasi responsive dengan CSS Flexbox tanpa library pihak ketiga?',
                        'documents' => [
                            [
                                'title' => 'Modul Praktik Web: Semantic HTML5 & Modern Styling',
                                'description' => 'Langkah demi langkah membuat landing page profil sekolah SMK yang responsive.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '5.1 MB',
                                'download_count' => 460,
                            ],
                            [
                                'title' => 'Starter Code & Asset Praktikum Web Dasar',
                                'description' => 'Koleksi file template HTML, CSS, dan gambar demo siap pakai.',
                                'document_type' => 'latihan',
                                'file_format' => 'ZIP',
                                'file_size' => '8.7 MB',
                                'download_count' => 620,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Dasar-Dasar Teknik Jaringan Komputer & Telekomunikasi (TJKT)',
                'slug' => 'dasar-dasar-tjkt',
                'code' => 'TJKT-101',
                'category' => 'kejuruan',
                'vocational_stream' => 'Teknik Komputer & Jaringan',
                'description' => 'Pengenalan arsitektur perangkat keras komputer, perakitan dan troubleshooting PC, media transmisi kabel (UTP/STP, Fiber Optic) dan nirkabel, model referensi OSI 7 Layer, serta pengalamatan IPv4 dasar.',
                'semester' => 'Semester 1 & 2',
                'total_hours' => 144,
                'icon' => 'network',
                'color' => 'emerald',
                'order' => 2,
                'topics' => [
                    [
                        'title' => 'Bab 1: Arsitektur Perangkat Keras & Perakitan Komputer Kerja',
                        'chapter_number' => 1,
                        'summary' => 'Mengenal fungsi komponen utama PC: Motherboard, CPU, RAM, GPU, PSU, Storage (NVMe vs SATA), teknik perakitan aman, dan diagnosis BIOS/UEFI POST.',
                        'key_points' => [
                            'Spesifikasi dan kompatibilitas soket prosesor, chipset motherboard, dan jenis RAM',
                            'Prosedur Electrostatic Discharge (ESD) dan keselamatan perakitan hardware',
                            'Konfigurasi BIOS/UEFI dan pembuatan media instalasi OS bootable',
                        ],
                        'estimated_minutes' => 30,
                        'ai_prompt_suggestion' => 'Jelaskan tanda-tanda kerusakan hardware komputer berdasarkan kode beep BIOS (Phoenix, AMI, Award).',
                        'documents' => [
                            [
                                'title' => 'Jobsheet: Perakitan Komputer Standar Laboratorium SMK',
                                'description' => 'Langkah verifikasi checklist perakitan dan pengujian performa komputer.',
                                'document_type' => 'jobsheet',
                                'file_format' => 'PDF',
                                'file_size' => '3.9 MB',
                                'download_count' => 290,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Bab 2: Model Referensi OSI 7 Layer & Pengalamatan IPv4',
                        'chapter_number' => 2,
                        'summary' => 'Pemahaman mendalam tentang abstraksi komunikasi data melalui model OSI 7 Layer dan TCP/IP, klasifikasi IPv4 (Class A, B, C), Subnetting CIDR, dan perhitungan IP host/network/broadcast.',
                        'key_points' => [
                            'Fungsi tiap layer: Physical, Data Link, Network, Transport, Session, Presentation, Application',
                            'Perbedaan protokol TCP (connection-oriented) dan UDP (connectionless)',
                            'Teknik perhitungan Subnetting CIDR /24 hingga /30 dengan metode cepat',
                        ],
                        'estimated_minutes' => 45,
                        'ai_prompt_suggestion' => 'Buatkan panduan menghitung subnet mask, network address, dan usable host untuk IP 192.168.10.65/27.',
                        'documents' => [
                            [
                                'title' => 'Buku Saku Subnetting IPv4 & Cheat Sheet CIDR',
                                'description' => 'Tabel praktis perhitungan subnetting lengkap untuk persiapan ujian kompetensi.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '2.1 MB',
                                'download_count' => 740,
                                'is_featured' => true,
                            ],
                        ],
                    ],
                ],
            ],

            // Mapel Umum
            [
                'name' => 'Informatika SMK',
                'slug' => 'informatika-smk',
                'code' => 'INF-101',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Mata pelajaran wajib Kurikulum Merdeka yang mencakup Berpikir Komputasional (BK), Teknologi Informasi dan Komunikasi (TIK), Sistem Komputer (SK), Jaringan Komputer dan Internet (JKI), serta Analisis Data (AD).',
                'semester' => 'Semester 1 & 2',
                'total_hours' => 108,
                'icon' => 'cpu',
                'color' => 'blue',
                'order' => 3,
                'topics' => [
                    [
                        'title' => 'Bab 1: Berpikir Komputasional (Computational Thinking)',
                        'chapter_number' => 1,
                        'summary' => 'Melatih kemampuan berpikir kritis memecahkan masalah kompleks melalui abstraksi data, pola berulang, optimasi pencarian (searching) dan pengurutan (sorting).',
                        'key_points' => [
                            'Struktur data dasar: Array, Stack (LIFO), Queue (FIFO), Tree, dan Graph',
                            'Algoritma pencarian: Linear Search vs Binary Search',
                            'Penerapan logika deduktif dan induktif dalam penyelesaian masalah sehari-hari',
                        ],
                        'estimated_minutes' => 30,
                        'ai_prompt_suggestion' => 'Berikan simulasi cara kerja Stack LIFO vs Queue FIFO dengan analogi kehidupan nyata anak SMK.',
                        'documents' => [
                            [
                                'title' => 'Modul Pembelajaran Informatika: Berpikir Komputasional',
                                'description' => 'Modul Kurikulum Merdeka resmi panduan guru dan siswa.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '3.8 MB',
                                'download_count' => 410,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Matematika Terapan',
                'slug' => 'matematika-terapan-10',
                'code' => 'MTK-101',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Matematika kejuruan yang difokuskan pada aljabar, matriks, sistem persamaan linear dua variabel, barisan dan deret, serta trigonometri terapan untuk bidang teknologi dan komputasi.',
                'semester' => 'Semester 1 & 2',
                'total_hours' => 108,
                'icon' => 'calculator',
                'color' => 'amber',
                'order' => 4,
                'topics' => [
                    [
                        'title' => 'Bab 1: Eksponen, Logaritma & Sistem Persamaan Linear',
                        'chapter_number' => 1,
                        'summary' => 'Operasi eksponen bilangan berpangkat, konsep logaritma dasar, dan pemodelan matematis masalah kontekstual ke dalam sistem persamaan linear.',
                        'key_points' => [
                            'Sifat-sifat eksponensial dan logaritma dalam perhitungan komputasi',
                            'Metode eliminasi dan substitusi pada SPLDV/SPLTV',
                            'Penerapan barisan aritmatika dan geometri dalam pertumbuhan data',
                        ],
                        'estimated_minutes' => 30,
                        'ai_prompt_suggestion' => 'Tunjukkan bagaimana operasi matriks digunakan dalam grafika komputer dan rendering 2D/3D.',
                        'documents' => [
                            [
                                'title' => 'Rangkuman Rumus Matematika Terapan SMK Kelas 10',
                                'description' => 'Kompilasi rumus dan cara cepat penyelesaian soal ujian semester.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '2.5 MB',
                                'download_count' => 380,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Bahasa Inggris Teknis (Technical English)',
                'slug' => 'bahasa-inggris-teknis-10',
                'code' => 'ENG-101',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Penguasaan bahasa Inggris berorientasi vokasi: membaca dokumentasi teknis (technical docs), manual instalasi perangkat, kosakata industri software, dan korespondensi email profesional.',
                'semester' => 'Semester 1 & 2',
                'total_hours' => 72,
                'icon' => 'globe',
                'color' => 'violet',
                'order' => 5,
                'topics' => [
                    [
                        'title' => 'Bab 1: Reading Technical Specifications & Error Logs',
                        'chapter_number' => 1,
                        'summary' => 'Teknik skimming dan scanning untuk memahami dokumentasi API, troubleshooting panduan error compiler, dan memahami changelog software.',
                        'key_points' => [
                            'Technical vocabulary in software development and network infrastructure',
                            'Understanding imperative mood in installation and configuration guides',
                            'Composing professional issue reports and technical documentation',
                        ],
                        'estimated_minutes' => 25,
                        'ai_prompt_suggestion' => 'Help me write a professional GitHub issue report in English about a database connection timeout error.',
                        'documents' => [
                            [
                                'title' => 'Vocabulary Guide: Software Development in English',
                                'description' => 'Kamus istilah bahasa Inggris teknis untuk developer pemula.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '1.9 MB',
                                'download_count' => 310,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Projek IPAS (Ilmu Pengetahuan Alam & Sosial)',
                'slug' => 'projek-ipas-10',
                'code' => 'IPAS-101',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Mengintegrasikan fenomena sains alam dan interaksi sosial dengan pendekatan projek kontekstual: energi terbarukan, dampak limbah elektronik (e-waste), dan mitigasi perubahan iklim.',
                'semester' => 'Semester 1 & 2',
                'total_hours' => 72,
                'icon' => 'flask',
                'color' => 'emerald',
                'order' => 6,
                'topics' => [
                    [
                        'title' => 'Bab 1: Pengelolaan Limbah Elektronik & Efisiensi Energi Digital',
                        'chapter_number' => 1,
                        'summary' => 'Studi komprehensif mengenai bahaya limbah perangkat keras komputer (e-waste), siklus daur ulang komponen elektronik, dan tren green computing pada pusat data.',
                        'key_points' => [
                            'Klasifikasi zat berbahaya dalam komponen komputer (timbal, merkuri, kadmium)',
                            'Prinsip 3R (Reduce, Reuse, Recycle) pada perangkat IT usang',
                            'Efisiensi konsumsi daya komputasi dan pendinginan server modern',
                        ],
                        'estimated_minutes' => 25,
                        'ai_prompt_suggestion' => 'Jelaskan konsep Green Computing dan bagaimana programmer dapat menulis kode yang hemat energi baterai server.',
                        'documents' => [
                            [
                                'title' => 'Panduan Projek IPAS: Pengelolaan E-Waste Laboratorium Komputer',
                                'description' => 'Panduan pelaksanaan projek terpadu IPAS Kurikulum Merdeka.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '2.8 MB',
                                'download_count' => 205,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->insertSubjects($grade, $subjects);
    }

    protected function seedKelas11(GradeLevel $grade): void
    {
        $subjects = [
            // Kejuruan
            [
                'name' => 'Pemrograman Berorientasi Objek (PBO)',
                'slug' => 'pemrograman-berorientasi-objek',
                'code' => 'PBO-201',
                'category' => 'kejuruan',
                'vocational_stream' => 'Pengembangan Perangkat Lunak & Gim',
                'description' => 'Mendalami paradigma Object-Oriented Programming (OOP): Class, Object, 4 Pilar OOP (Encapsulation, Inheritance, Polymorphism, Abstraction), Interface, Abstract Class, dan Exception Handling dengan Java & PHP modern.',
                'semester' => 'Semester 3 & 4',
                'total_hours' => 144,
                'icon' => 'code',
                'color' => 'brand',
                'order' => 1,
                'topics' => [
                    [
                        'title' => 'Bab 1: Pengenalan Paradigma OOP & Konstruksi Class-Object',
                        'chapter_number' => 1,
                        'summary' => 'Pergeseran paradigma dari prosedural ke OOP. Mempelajari struktur deklarasi Class, instansiasi Object, atribut (properties), method, constructor, destructor, dan kata kunci "this".',
                        'key_points' => [
                            'Konsep analogi cetak biru (blueprint) Class dan wujud nyata Object',
                            'Peran Constructor dalam inisialisasi state awal suatu objek',
                            'Visibility modifier: public, private, dan protected untuk data hiding',
                        ],
                        'estimated_minutes' => 35,
                        'ai_prompt_suggestion' => 'Berikan analogi sederhana untuk menjelaskan perbedaan Class dan Object beserta contoh kode PHP 8!',
                        'documents' => [
                            [
                                'title' => 'Buku Ajar PBO: Fondasi Paradigma Objek & Analogi Praktis',
                                'description' => 'Modul komprehensif konsep dasar OOP dengan diagram UML Class.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '4.5 MB',
                                'download_count' => 580,
                                'is_featured' => true,
                            ],
                            [
                                'title' => 'Jobsheet 01: Praktik Deklarasi Class dan Constructor',
                                'description' => 'Panduan latihan pembuatan sistem entitas siswa dan inventaris sekolah.',
                                'document_type' => 'jobsheet',
                                'file_format' => 'PDF',
                                'file_size' => '2.1 MB',
                                'download_count' => 390,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Bab 2: Empat Pilar OOP (Inheritance, Encapsulation, Polymorphism, Abstraction)',
                        'chapter_number' => 2,
                        'summary' => 'Mendalami 4 pilar utama rekayasa perangkat lunak berorientasi objek: pewarisan sifat antar class (inheritance), enkapsulasi data via getter/setter, fleksibilitas bentuk polimorfisme (overriding & overloading), serta pemisahan kontrak via Interface dan Abstract Class.',
                        'key_points' => [
                            'Penggunaan extends untuk inheritance dan kata kunci super / parent',
                            'Perbedaan krusial antara Abstract Class dan Interface kapan harus digunakan',
                            'Method Overriding untuk mengubah implementasi perilaku parent class secara dinamis',
                        ],
                        'estimated_minutes' => 45,
                        'ai_prompt_suggestion' => 'Kapan seorang software engineer harus memilih Interface daripada Abstract Class? Berikan contoh kasus nyata!',
                        'documents' => [
                            [
                                'title' => 'Modul Pendalaman: 4 Pilar OOP & Best Practices',
                                'description' => 'Studi kasus implementasi sistem perbankan menggunakan enkapsulasi dan polimorfisme.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '5.6 MB',
                                'download_count' => 610,
                                'is_featured' => true,
                            ],
                            [
                                'title' => 'Slide Kuliah: Polimorfisme & Abstraksi Sistem',
                                'description' => 'Slide presentasi visual pemetaan diagram arsitektur OOP.',
                                'document_type' => 'slide',
                                'file_format' => 'PPTX',
                                'file_size' => '7.4 MB',
                                'download_count' => 230,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Pemrograman Web & Perangkat Bergerak (PWPB)',
                'slug' => 'pemrograman-web-perangkat-bergerak',
                'code' => 'PWPB-201',
                'category' => 'kejuruan',
                'vocational_stream' => 'Pengembangan Perangkat Lunak & Gim',
                'description' => 'Pengembangan aplikasi web dinamis dengan arsitektur Model-View-Controller (MVC), Framework Laravel, template engine Blade, autentikasi session/token, RESTful API endpoints, dan dasar integrasi mobile view.',
                'semester' => 'Semester 3 & 4',
                'total_hours' => 180,
                'icon' => 'globe',
                'color' => 'blue',
                'order' => 2,
                'topics' => [
                    [
                        'title' => 'Bab 1: Arsitektur Model-View-Controller (MVC) & Routing Laravel',
                        'chapter_number' => 1,
                        'summary' => 'Memahami pola desain MVC untuk memisahkan logika bisnis, antarmuka pengguna, dan manipulasi data. Konfigurasi route, controller method, request lifecycle, dan dependency injection.',
                        'key_points' => [
                            'Alur Request Lifecycle Laravel dari public/index.php hingga Controller dan View',
                            'Route grouping, naming, route parameters, dan middleware security',
                            'Pemanfaatan Blade template engine: layouts, components, dan slots',
                        ],
                        'estimated_minutes' => 40,
                        'ai_prompt_suggestion' => 'Jelaskan bagaimana data mengalir dari URL di browser hingga ditampilkan ke Blade View dalam Framework Laravel!',
                        'documents' => [
                            [
                                'title' => 'Buku Panduan Belajar Laravel Modern untuk SMK',
                                'description' => 'Panduan terstruktur belajar framework Laravel dari nol hingga mahir.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '6.8 MB',
                                'download_count' => 840,
                                'is_featured' => true,
                            ],
                            [
                                'title' => 'Repository Source Code Project Toko Online Sederhana',
                                'description' => 'Kode sumber lengkap aplikasi e-commerce sekolah dengan Laravel Blade.',
                                'document_type' => 'latihan',
                                'file_format' => 'ZIP',
                                'file_size' => '12.4 MB',
                                'download_count' => 950,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Basis Data Relasional & Desain SQL',
                'slug' => 'basis-data-relasional-sql',
                'code' => 'BD-201',
                'category' => 'kejuruan',
                'vocational_stream' => 'Pengembangan Perangkat Lunak & Gim',
                'description' => 'Perancangan Entity Relationship Diagram (ERD), normalisasi tabel (1NF, 2NF, 3NF), Data Definition Language (DDL), Data Manipulation Language (DML), agregasi SQL, indexing, transaction ACID, dan PostgreSQL/MySQL.',
                'semester' => 'Semester 3 & 4',
                'total_hours' => 144,
                'icon' => 'database',
                'color' => 'emerald',
                'order' => 3,
                'topics' => [
                    [
                        'title' => 'Bab 1: Normalisasi Data & Perancangan ERD Skala Produksi',
                        'chapter_number' => 1,
                        'summary' => 'Metodologi sistematis merancang skema database yang bebas redundansi dan inkonsistensi anomali. Tahapan normalisasi dari unnormalized form hingga 3rd Normal Form (3NF).',
                        'key_points' => [
                            'Identifikasi entitas, relasi One-to-One, One-to-Many, dan Many-to-Many (junction table)',
                            'Kaidah pemisahan atribut parsial (2NF) dan dependensi transitif (3NF)',
                            'Penentuan Primary Key, Foreign Key, dan Unique Indexing untuk integritas referensial',
                        ],
                        'estimated_minutes' => 35,
                        'ai_prompt_suggestion' => 'Berikan contoh proses normalisasi tabel faktur penjualan dari bentuk Unnormalized sampai 3NF langkah demi langkah.',
                        'documents' => [
                            [
                                'title' => 'Buku Panduan Desain ERD & Normalisasi Database',
                                'description' => 'Studi kasus perancangan skema database sistem perpustakaan dan akademik SMK.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '4.2 MB',
                                'download_count' => 620,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Administrasi Infrastruktur Jaringan (AIJ)',
                'slug' => 'administrasi-infrastruktur-jaringan',
                'code' => 'AIJ-201',
                'category' => 'kejuruan',
                'vocational_stream' => 'Teknik Komputer & Jaringan',
                'description' => 'Konfigurasi Virtual Local Area Network (VLAN), Inter-VLAN routing, Access Control List (ACL), manajemen bandwidth (Queue Tree), Network Address Translation (NAT), dan firewall router Mikrotik/Cisco.',
                'semester' => 'Semester 3 & 4',
                'total_hours' => 144,
                'icon' => 'server',
                'color' => 'violet',
                'order' => 4,
                'topics' => [
                    [
                        'title' => 'Bab 1: Konfigurasi Virtual LAN (VLAN) & Trunking 802.1Q',
                        'chapter_number' => 1,
                        'summary' => 'Segmentasi jaringan logis menggunakan VLAN ID, port access vs port trunk, enkapsulasi IEEE 802.1Q, dan teknik Router-on-a-Stick untuk menghubungkan antar subnet VLAN.',
                        'key_points' => [
                            'Keuntungan VLAN dalam mereduksi broadcast domain dan meningkatkan keamanan',
                            'Perbedaan fungsi Port Access (untagged) dan Port Trunk (tagged)',
                            'Implementasi sub-interface router untuk routing antar VLAN',
                        ],
                        'estimated_minutes' => 35,
                        'ai_prompt_suggestion' => 'Bagaimana cara mengatasi masalah port trunking pada switch Cisco saat VLAN tidak bisa saling berkomunikasi?',
                        'documents' => [
                            [
                                'title' => 'Jobsheet: Lab Praktikum VLAN & Trunking Mikrotik',
                                'description' => 'Panduan simulasi menggunakan software GNS3 dan Cisco Packet Tracer.',
                                'document_type' => 'jobsheet',
                                'file_format' => 'PDF',
                                'file_size' => '3.5 MB',
                                'download_count' => 450,
                            ],
                        ],
                    ],
                ],
            ],

            // Mapel Umum
            [
                'name' => 'Matematika Diskrit & Logika Terapan',
                'slug' => 'matematika-diskrit-11',
                'code' => 'MTK-201',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Matematika untuk komputasi tingkat lanjut: logika proposisi, tabel kebenaran boolean, teori himpunan, relasi dan fungsi, teori graf (Dijkstra algorithm), dan kombinatorika probabilitas.',
                'semester' => 'Semester 3 & 4',
                'total_hours' => 108,
                'icon' => 'calculator',
                'color' => 'amber',
                'order' => 5,
                'topics' => [
                    [
                        'title' => 'Bab 1: Teori Graf & Penerapan Algoritma Jalur Terpendek',
                        'chapter_number' => 1,
                        'summary' => 'Studi struktur data Graf (simpul dan sisi), graf berbobot, representasi matriks ketetanggaan (adjacency matrix), serta implementasi algoritma Dijkstra untuk navigasi rute tercepat.',
                        'key_points' => [
                            'Terminologi Graf: vertex, edge, directed vs undirected, weight',
                            'Langkah kerja Algoritma Dijkstra dalam mencari shortest path',
                            'Penerapan graf pada topologi jaringan komputer dan sistem routing',
                        ],
                        'estimated_minutes' => 35,
                        'ai_prompt_suggestion' => 'Jelaskan cara kerja Algoritma Dijkstra mencari rute tercepat menggunakan tabel langkah!',
                        'documents' => [
                            [
                                'title' => 'Modul Matematika Diskrit: Teori Graf & Pohon Rentang',
                                'description' => 'Bahan ajar pengantar matematika komputasi dan kecerdasan buatan.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '3.1 MB',
                                'download_count' => 290,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Pendidikan Pancasila & Etika Profesi IT',
                'slug' => 'pendidikan-pancasila-etika-it-11',
                'code' => 'PPN-201',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Penguatan kesadaran hukum digital, UU Informasi dan Transaksi Elektronik (UU ITE), Undang-Undang Perlindungan Data Pribadi (UU PDP), hak kekayaan intelektual (HKI), dan etika kode etik profesi ACM/IEEE.',
                'semester' => 'Semester 3 & 4',
                'total_hours' => 72,
                'icon' => 'shield',
                'color' => 'rose',
                'order' => 6,
                'topics' => [
                    [
                        'title' => 'Bab 1: Etika Siber, Privasi Data & UU ITE',
                        'chapter_number' => 1,
                        'summary' => 'Tinjauan yuridis mengenai kejahatan siber (cybercrime), perlindungan data privasi konsumen dalam aplikasi digital, dan pertanggungjawaban hukum bagi software developer.',
                        'key_points' => [
                            'Pasal-pasal penting UU ITE terkait akses ilegal dan manipulasi data',
                            'Kepatuhan UU Pelindungan Data Pribadi (PDP) dalam desain sistem software',
                            'Kode etik profesi rekayasa perangkat lunak internasional (ACM/IEEE Code of Ethics)',
                        ],
                        'estimated_minutes' => 25,
                        'ai_prompt_suggestion' => 'Apa saja kewajiban seorang pengembang web menurut UU Perlindungan Data Pribadi (PDP) di Indonesia?',
                        'documents' => [
                            [
                                'title' => 'Kompilasi Hukum Siber & Etika Profesi Rekayasa Software',
                                'description' => 'Panduan hukum praktis untuk developer muda SMK.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '2.3 MB',
                                'download_count' => 210,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->insertSubjects($grade, $subjects);
    }

    protected function seedKelas12(GradeLevel $grade): void
    {
        $subjects = [
            // Kejuruan
            [
                'name' => 'Pemrograman Web Skala Industri & Cloud Architecture',
                'slug' => 'pemrograman-web-industri-cloud',
                'code' => 'PWI-301',
                'category' => 'kejuruan',
                'vocational_stream' => 'Pengembangan Perangkat Lunak & Gim',
                'description' => 'Membangun aplikasi web fullstack skala industri: arsitektur RESTful API modern, integrasi Next.js/Vue dengan backend Laravel, Docker containerization, CI/CD pipeline GitHub Actions, dan hosting cloud.',
                'semester' => 'Semester 5 & 6',
                'total_hours' => 180,
                'icon' => 'cloud',
                'color' => 'brand',
                'order' => 1,
                'topics' => [
                    [
                        'title' => 'Bab 1: Desain RESTful API Standar & Autentikasi Token (Sanctum/JWT)',
                        'chapter_number' => 1,
                        'summary' => 'Perancangan API yang idempotent dan scalable. HTTP verbs (GET, POST, PUT, PATCH, DELETE), status code standar (200, 201, 400, 401, 403, 422, 500), API Resource transformations, dan autentikasi stateless.',
                        'key_points' => [
                            'Prinsip arsitektur REST: Stateless, Client-Server, Cacheable, Layered System',
                            'Implementasi JSON Web Token (JWT) dan token bearer authentication',
                            'Validasi request payload dan penanganan response error standar JSON',
                        ],
                        'estimated_minutes' => 45,
                        'ai_prompt_suggestion' => 'Buatkan contoh spesifikasi REST API CRUD Produk lengkap dengan HTTP Status Code dan JSON Response standar industri!',
                        'documents' => [
                            [
                                'title' => 'Panduan Lengkap Arsitektur RESTful API & Keamanan Token',
                                'description' => 'Best practices industri pembuatan endpoint API enterprise.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '5.2 MB',
                                'download_count' => 780,
                                'is_featured' => true,
                            ],
                            [
                                'title' => 'Koleksi Postman Collection API Testing',
                                'description' => 'File impor Postman untuk pengujian otomatis endpoint backend.',
                                'document_type' => 'latihan',
                                'file_format' => 'ZIP',
                                'file_size' => '1.4 MB',
                                'download_count' => 610,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Bab 2: Kontainerisasi Docker & Otomasi CI/CD Pipeline',
                        'chapter_number' => 2,
                        'summary' => 'Pengemasan aplikasi menggunakan Dockerfile dan Docker Compose untuk konsistensi lingkungan development dan produksi. Penyusunan workflow CI/CD otomatis dengan GitHub Actions untuk testing dan auto-deploy.',
                        'key_points' => [
                            'Memahami konsep Image, Container, Volume, dan Network pada Docker',
                            'Menulis Docker Compose multi-container: Nginx, PHP-FPM, MySQL, dan Redis',
                            'Membuat file workflow GitHub Actions untuk linting, automated testing, dan deploy',
                        ],
                        'estimated_minutes' => 40,
                        'ai_prompt_suggestion' => 'Bagaimana cara menulis Dockerfile multi-stage build yang optimal dan berukuran kecil untuk aplikasi web?',
                        'documents' => [
                            [
                                'title' => 'Modul Praktik DevOps SMK: Docker & GitHub Actions',
                                'description' => 'Langkah praktis menerapkan budaya DevOps di lingkungan magang PKL.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '4.7 MB',
                                'download_count' => 520,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Keamanan Sistem & Informasi (Cyber Security)',
                'slug' => 'keamanan-sistem-informasi-cybersecurity',
                'code' => 'CYB-301',
                'category' => 'kejuruan',
                'vocational_stream' => 'Pengembangan Perangkat Lunak & Jaringan',
                'description' => 'Identifikasi kerentanan aplikasi web berdasarkan panduan OWASP Top 10 (SQL Injection, XSS, CSRF, Broken Access Control), teknik hashing password (Bcrypt/Argon2), enkripsi data SSL/TLS, dan audit keamanan sistem.',
                'semester' => 'Semester 5 & 6',
                'total_hours' => 144,
                'icon' => 'shield',
                'color' => 'rose',
                'order' => 2,
                'topics' => [
                    [
                        'title' => 'Bab 1: Mitigasi OWASP Top 10 & Pertahanan Aplikasi Web',
                        'chapter_number' => 1,
                        'summary' => 'Eksplorasi ancaman celah keamanan web paling kritis menurut OWASP. Analisis payload serangan SQL Injection dan Cross-Site Scripting (XSS) serta cara pencegahan defensif menggunakan parameterized queries dan content sanitization.',
                        'key_points' => [
                            'Mekanisme serangan SQLi dan pencegahan mutlak dengan PDO Prepared Statements',
                            'Perbedaan Stored XSS, Reflected XSS, dan DOM-based XSS beserta mitigasi Content Security Policy (CSP)',
                            'Pencegahan Cross-Site Request Forgery (CSRF) menggunakan synchronized token pattern',
                        ],
                        'estimated_minutes' => 45,
                        'ai_prompt_suggestion' => 'Jelaskan bagaimana SQL Injection terjadi pada query dinamis dan tunjukkan cara memperbaikinya dengan Prepared Statement!',
                        'documents' => [
                            [
                                'title' => 'Buku Saku OWASP Top 10 Web Vulnerability Guide',
                                'description' => 'Panduan ringkas identifikasi dan penambalan celah keamanan web.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '3.6 MB',
                                'download_count' => 640,
                                'is_featured' => true,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Proyek Kreatif & Kewirausahaan (PKK Digital)',
                'slug' => 'proyek-kreatif-kewirausahaan-pkk',
                'code' => 'PKK-301',
                'category' => 'kejuruan',
                'vocational_stream' => 'Semua Konsentrasi Keahlian',
                'description' => 'Inkubasi produk teknologi nyata (SaaS, Mobile App, IoT): Business Model Canvas (BMC), riset pasar pengguna, prototipe MVP (Minimum Viable Product), strategi pemasaran digital, perhitungan HPP & ROI, dan pitching deck.',
                'semester' => 'Semester 5 & 6',
                'total_hours' => 180,
                'icon' => 'rocket',
                'color' => 'amber',
                'order' => 3,
                'topics' => [
                    [
                        'title' => 'Bab 1: Perancangan Business Model Canvas (BMC) & Validasi Ide Startup',
                        'chapter_number' => 1,
                        'summary' => 'Membedah 9 blok Business Model Canvas untuk memvalidasi ide produk digital: Value Proposition, Customer Segments, Channels, Revenue Streams, Cost Structure, dan Key Partnerships.',
                        'key_points' => [
                            'Memetakan masalah nyata masyarakat menjadi Value Proposition yang bernilai jual',
                            'Menentukan target demografis dan behavioral persona pembeli',
                            'Menghitung unit economics, Customer Acquisition Cost (CAC), dan Lifetime Value (LTV)',
                        ],
                        'estimated_minutes' => 35,
                        'ai_prompt_suggestion' => 'Bantu saya menyusun 9 blok Business Model Canvas (BMC) untuk ide platform les privat online siswa SMK!',
                        'documents' => [
                            [
                                'title' => 'Template Business Model Canvas (BMC) & Panduan Pitching',
                                'description' => 'Dokumen kerja standar presentasi kompetisi kewirausahaan dan investor.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '2.9 MB',
                                'download_count' => 520,
                            ],
                        ],
                    ],
                ],
            ],

            // Mapel Umum
            [
                'name' => 'Bahasa Indonesia Portofolio & Komunikasi Karir',
                'slug' => 'bahasa-indonesia-portofolio-12',
                'code' => 'BIN-301',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Penyusunan laporan Praktik Kerja Lapangan (PKL), penulisan karya ilmiah teknologi, pembuatan Curriculum Vitae (CV) ATS-Friendly, surat lamaran kerja profesional, dan teknik wawancara kerja teknis.',
                'semester' => 'Semester 5 & 6',
                'total_hours' => 72,
                'icon' => 'document',
                'color' => 'blue',
                'order' => 4,
                'topics' => [
                    [
                        'title' => 'Bab 1: Penulisan Laporan PKL & Pembuatan Portofolio ATS',
                        'chapter_number' => 1,
                        'summary' => 'Sistematika penulisan karya ilmiah laporan magang industri SMK, standardisasi tata bahasa baku PUEBI, dan perancangan portofolio projek digital yang lolos seleksi Applicant Tracking System (ATS).',
                        'key_points' => [
                            'Format baku bab pendahuluan, metodologi sistem, dan analisis hasil PKL',
                            'Kata kerja tindakan (action verbs) dalam mendeskripsikan pengalaman projek di CV',
                            'Strategi presentasi sidang tugas akhir / sidang magang di hadapan penguji industri',
                        ],
                        'estimated_minutes' => 30,
                        'ai_prompt_suggestion' => 'Berikan contoh deskripsi pengalaman kerja projek web developer di CV yang berbobot dan ramah sistem ATS!',
                        'documents' => [
                            [
                                'title' => 'Panduan Format Baku Laporan PKL & Template CV ATS',
                                'description' => 'Template dokumen resmi siap edit untuk keperluan kelulusan dan karir.',
                                'document_type' => 'modul',
                                'file_format' => 'DOCX',
                                'file_size' => '1.5 MB',
                                'download_count' => 890,
                                'is_featured' => true,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Bahasa Inggris Persiapan Karir Global',
                'slug' => 'bahasa-inggris-karir-global-12',
                'code' => 'ENG-301',
                'category' => 'umum',
                'vocational_stream' => null,
                'description' => 'Kesiapan komunikasi kerja internasional (remote work): wawancara teknis bahasa Inggris, presentasi demo produk digital, negosiasi kontrak freelance, dan etika profesional global.',
                'semester' => 'Semester 5 & 6',
                'total_hours' => 72,
                'icon' => 'globe',
                'color' => 'violet',
                'order' => 5,
                'topics' => [
                    [
                        'title' => 'Bab 1: Technical Job Interview & Remote Work Communication',
                        'chapter_number' => 1,
                        'summary' => 'Simulasi wawancara kerja teknis dalam bahasa Inggris, teknik menjawab metode STAR (Situation, Task, Action, Result), dan komunikasi asinkron di platform kerja global (Slack, GitHub, Jira).',
                        'key_points' => [
                            'Answering common behavioral interview questions with the STAR technique',
                            'Explaining architectural decisions and code problem-solving in English',
                            'Professional email writing for international client outreach',
                        ],
                        'estimated_minutes' => 30,
                        'ai_prompt_suggestion' => 'Conduct a mock technical job interview in English for a junior frontend developer position. Ask me one question at a time!',
                        'documents' => [
                            [
                                'title' => 'Job Interview Playbook: English for Software Engineers',
                                'description' => 'Kompilasi pertanyaan wawancara teknis paling sering ditanyakan di perusahaan teknologi.',
                                'document_type' => 'modul',
                                'file_format' => 'PDF',
                                'file_size' => '2.6 MB',
                                'download_count' => 430,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->insertSubjects($grade, $subjects);
    }

    /**
     * @param  array<int, array<string, mixed>>  $subjects
     */
    protected function insertSubjects(GradeLevel $grade, array $subjects): void
    {
        foreach ($subjects as $subjectData) {
            $topics = $subjectData['topics'] ?? [];
            unset($subjectData['topics']);

            $subjectData['grade_level_id'] = $grade->id;
            $subject = Subject::updateOrCreate(
                [
                    'grade_level_id' => $grade->id,
                    'slug' => $subjectData['slug'],
                ],
                $subjectData
            );

            foreach ($topics as $topicData) {
                $documents = $topicData['documents'] ?? [];
                unset($topicData['documents']);

                $topicData['subject_id'] = $subject->id;
                $topicData['slug'] = Str::slug($topicData['title']);

                $topic = SubjectTopic::updateOrCreate(
                    [
                        'subject_id' => $subject->id,
                        'slug' => $topicData['slug'],
                    ],
                    $topicData
                );

                foreach ($documents as $docData) {
                    $docData['subject_id'] = $subject->id;
                    $docData['subject_topic_id'] = $topic->id;

                    SubjectDocument::updateOrCreate(
                        [
                            'subject_id' => $subject->id,
                            'title' => $docData['title'],
                        ],
                        $docData
                    );
                }
            }
        }
    }
}
