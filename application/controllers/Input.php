<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Input extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('key');
		authentication();
    }

    public function quest()
    {
        $id = $this->uri->segment(3);
        $main_id = $this->key->crypts($this->uri->segment(4), 'd');

        $data['title'] = 'Survey Pemutakhiran DTKS - Kab. Bojonegoro';

        $data['hasil_pencacahan'] = $this->db->get('hasil_pencacahan')->result_array();
        $data['status_bangunan'] = $this->db->get('status_bangunan')->result_array();
        $data['status_lahan'] = $this->db->get('status_lahan')->result_array();
        $data['jenis_lantai'] = $this->db->get('jenis_lantai')->result_array();
        $data['jenis_dinding'] = $this->db->get('jenis_dinding')->result_array();
        $data['kondisi_dinding'] = $this->db->get('kondisi_dinding')->result_array();
        $data['jenis_atap'] = $this->db->get('jenis_atap')->result_array();
        $data['kondisi_atap'] = $this->db->get('kondisi_atap')->result_array();
        $data['sumber_airminum'] = $this->db->get('sumber_airminum')->result_array();
        $data['cara_memperoleh_airminum'] = $this->db->get('cara_memperoleh_airminum')->result_array();
        $data['sumber_listrik'] = $this->db->get('sumber_listrik')->result_array();
        $data['daya_listrik'] = $this->db->get('daya_listrik')->result_array();
        $data['energi_untuk_memasak'] = $this->db->get('energi_untuk_memasak')->result_array();
        $data['status_toilet'] = $this->db->get('status_toilet')->result_array();
        $data['jenis_toilet'] = $this->db->get('jenis_toilet')->result_array();
        $data['tpa'] = $this->db->get('tpa')->result_array();

        $data['hubungan_rumah_tangga'] = $this->db->get('hubungan_rumah_tangga')->result_array();
        $data['hubungan_keluarga'] = $this->db->get('hubungan_keluarga')->result_array();
        $data['status_perkawinan'] = $this->db->get('status_perkawinan')->result_array();
        $data['penyakit_kronis'] = $this->db->get('penyakit_kronis')->result_array();
        $data['jenis_disabilitas'] = $this->db->get('jenis_disabilitas')->result_array();
        $data['apakah_perokok'] = $this->db->get('apakah_perokok')->result_array();
        $data['partisipasi_sekolah'] = $this->db->get('partisipasi_sekolah')->result_array();
        $data['jenjang_pendidikan'] = $this->db->get('jenjang_pendidikan')->result_array();
        $data['ijazah_terakhir'] = $this->db->get('ijazah_terakhir')->result_array();
        $data['lapangan_usaha'] = $this->db->get('lapangan_usaha')->result_array();
        $data['jabatan_pekerjaan'] = $this->db->get('jabatan_pekerjaan')->result_array();
        $data['status_anggota_ruta'] = $this->db->get('status_anggota_ruta')->result_array();

        if($this->session->userdata('user_level') == 1) {
            $data['ref_kecamatan'] = $this->db->where('id', $this->session->userdata('user_manager'))->get('ref_kecamatan')->result_array();
            $data['ref_desa'] = $this->db->where('id', $this->session->userdata('user_name'))->get('ref_desa')->result_array();
        } else {
            $data['ref_kecamatan'] = $this->db->get('ref_kecamatan')->result_array();
            $data['ref_desa'] = $this->db->get('ref_desa')->result_array();
        }
        

        $data['estimasi_pengeluaran'] = $this->db->get('estimasi_pengeluaran')->result_array();
        $data['jenis_bantuan'] = $this->db->get('jenis_bantuan')->result_array();

        $data['anggota_keluarga'] = $this->db->select("mkse.*, hk.desc as hubungan_keluarga, sp.desc as status_perkawinan")
        ->where("main_id", $main_id)
        // ->join("hubungan_rumah_tangga hrt", "mkse.hubungan_rumah_tangga_id = hrt.id")
        ->join("hubungan_keluarga hk", "mkse.hubungan_keluarga_id = hk.id")
        ->join("status_perkawinan sp", "mkse.status_perkawinan_id = sp.id")
        ->order_by("no_urut_keluarga")
        ->get('main_keterangan_sosial_ekonomi mkse')->result_array();

        $data['anggota_keluarga_memiliki_usaha'] = $this->db->select("mkse.*, lu.desc as lapangan_usaha")
        ->where("main_id", $main_id)
        ->join("lapangan_usaha lu", "mkse.lapangan_usaha_id = lu.id")
        ->get('main_keterangan_sosial_ekonomi mkse')->result_array();

        $data["main_id"] = $this->key->crypts($main_id, 'e');

        if($main_id != "") {
            $this->load->view('templates/header', $data);
            $this->load->view('input/input-'.$id, $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/404.html');
            $this->load->view('templates/footer');
        }
    }

    public function input1_create()
    {
        $errors = [];
        $data = [];

        $data_post = array(
            'provinsi_id'       => $this->input->post('provinsi_id'),
            'kabupaten_id'      => $this->input->post('kabupaten_id'),
            'kecamatan_id'      => $this->input->post('kecamatan_id'),
            'desa_id'           => $this->input->post('desa_id'),
            'rt'                => $this->input->post('rt'),
            'rw'                => $this->input->post('rw'),
            'dusun'             => $this->input->post('dusun'),
            'alamat'            => $this->input->post('alamat'),
            'no_urut_ruta'      => $this->input->post('no_urut_ruta'),
            'nama_krt'          => $this->input->post('nama_krt'),
            'no_kk_krt'         => $this->input->post('no_kk_krt'),
            'jumlah_art'        => $this->input->post('jumlah_art'),
            'jumlah_keluarga'   => $this->input->post('jumlah_keluarga'),
            'relasi_no_kk'      => $this->input->post('relasi_no_kk'),
            'created_by'        => 1,
        );

        $data_post = $this->security->xss_clean($data_post);

        if(empty($this->input->post('kecamatan_id'))) {
            $errors['kecamatan_id'] = 'Silakan pilih kecamatan';
        }

        if(empty($this->input->post('desa_id'))) {
            $errors['desa_id'] = 'Silakan pilih desa / kelurahan';
        }

        if(strlen($this->input->post('rw')) < 3) {
            $errors['rw'] = 'RW harus berisi 3 digit angka';
        }

        if(strlen($this->input->post('rt')) < 3) {
            $errors['rt'] = 'RT harus berisi 3 digit angka';
        }

        if(strlen($this->input->post('no_kk_krt')) < 16) {
            $errors['no_kk_krt'] = 'No. KK harus berisi 16 digit angka';
        }

        if(empty($this->input->post('nama_krt'))) {
            $errors['nama_krt'] = 'Nama Kepala Keluarga harus diisi';
        }

        if(!empty($this->input->post('relasi_no_kk')) && strlen($this->input->post('relasi_no_kk')) < 16) {
            $errors['relasi_no_kk'] = 'Relasi KK harus berisi 16 digit angka';
        }

        $query = $this->db->where('no_kk_krt', $this->input->post('no_kk_krt'))->get('main_pengenalan_tempat')->result_array();

        if(count($query) > 0) {
            $errors['no_kk_krt_exist'] = 'No. KK sudah terdaftar';
        }
        
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $this->db->insert('main_pengenalan_tempat', $data_post);
            $main_id = $this->db->insert_id();

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['main_id'] = $this->key->crypts($main_id, 'e');
        }
        
        echo json_encode($data);
    }

    public function input2_create()
    {
        $errors = [];
        $data = [];

        $main_id = $this->input->post('main_id');
        $main_id = $this->key->crypts($main_id, 'd');

        $data_post = array(
            'main_id'               => $main_id,
            'tanggal_pencacahan'    => $this->input->post('tanggal_pencacahan'),
            'nama_pencacah'         => $this->input->post('nama_pencacah'),
            'kode_pencacah'         => $this->input->post('kode_pencacah'),
            'tanggal_pemeriksaan'   => $this->input->post('tanggal_pemeriksaan'),
            'nama_pemeriksa'        => $this->input->post('nama_pemeriksa'),
            'kode_pemeriksa'        => $this->input->post('kode_pemeriksa'),
            'hasil_pencacahan'      => $this->input->post('hasil_pencacahan'),
            'bagian_no_ruta'        => $this->input->post('bagian_no_ruta'),
        );

        if(empty($main_id)) {
            $errors['main_id'] = 'Server sibuk ! Mohon refresh browser anda terlebih dahulu !';
        }

        if(empty($this->input->post('tanggal_pencacahan'))) {
            $errors['tanggal_pencacahan'] = 'Tanggal Pencacahan tidak boleh kosong';
        }

        if(empty($this->input->post('nama_pencacah'))) {
            $errors['nama_pencacah'] = 'Nama Pencacah tidak boleh kosong';
        }

        if(empty($this->input->post('tanggal_pemeriksaan'))) {
            $errors['tanggal_pemeriksaan'] = 'Tanggal Pemeriksaan tidak boleh kosong';
        }

        if(empty($this->input->post('nama_pemeriksa'))) {
            $errors['nama_pemeriksa'] = 'Nama Pemeriksa tidak boleh kosong';
        }
        
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $insert = $this->db->insert('main_keterangan_petugas_dan_responden', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['main_id'] = $this->key->crypts($main_id, 'e');
        }
        
        echo json_encode($data);
    }

    public function input3_create()
    {
        $errors = [];
        $data = [];

        $main_id = $this->input->post('main_id');
        $main_id = $this->key->crypts($main_id, 'd');

        $data_post = array(
            'main_id'                   => $main_id,
            'status_bangunan_1a'        => $this->input->post('status_bangunan_value'),
            'status_lahan_1b'           => $this->input->post('status_lahan_value'),
            'luas_lantai_2'             => $this->input->post('luas_lantai_value'),
            'jenis_lantai_3'            => $this->input->post('jenis_lantai_value'),
            'jenis_dinding_4a'          => $this->input->post('jenis_dinding_value'),
            'kondisi_dinding_4b'        => $this->input->post('kondisi_dinding_value'),
            'jenis_atap_5a'             => $this->input->post('jenis_atap_value'),
            'kondisi_atap_5b'           => $this->input->post('kondisi_atap_value'),
            'jumlah_kamar_6'            => $this->input->post('jumlah_kamar_value'),
            'sumber_airminum_7'         => $this->input->post('sumber_airminum_value'),
            'cara_memperoleh_airminum_8'=> $this->input->post('cara_memperoleh_airminum_value'),
            'sumber_listrik_9a'         => $this->input->post('sumber_listrik_value'),
            'daya_listrik_9b'           => $this->input->post('daya_listrik_value'),
            'id_pelanggan_9c'           => $this->input->post('id_pelanggan_value'),
            'energi_untuk_memasak_10'   => $this->input->post('energi_untuk_memasak_value'),
            'status_toilet_11a'         => $this->input->post('status_toilet_value'),
            'jenis_toilet_11b'          => $this->input->post('jenis_toilet_value'),
            'tpa_12'                    => $this->input->post('tpa_value'),
        );
        
        if(empty($main_id)) {
            $errors['main_id'] = 'Server sibuk ! Mohon refresh browser anda terlebih dahulu !';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $insert = $this->db->insert('main_keterangan_perumahan', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['main_id'] = $data["main_id"] = $this->key->crypts($main_id, 'e');
        }
        
        echo json_encode($data);
    }

    public function input4_create()
    {
        $errors = [];
        $data = [];

        $main_id = $this->input->post('main_id');
        $main_id = $this->key->crypts($main_id, 'd');

        $data_post = array(
            'main_id'                   => $main_id,
            'no_urut_keluarga'          => $this->input->post('no_urut_keluarga'),
            'nik_anggota'               => $this->input->post('nik_anggota'),
            'nama_anggota'              => $this->input->post('nama_anggota'),
            'hubungan_rumah_tangga_id'  => $this->input->post('hubungan_rumah_tangga_id'),
            'hubungan_keluarga_id'      => $this->input->post('hubungan_keluarga_id'),
            'jenis_kelamin'             => $this->input->post('jenis_kelamin'),
            'tanggal_lahir'             => $this->input->post('tanggal_lahir'),
            'umur'                      => $this->input->post('umur'),
            'status_perkawinan_id'      => $this->input->post('status_perkawinan_id'),
            'status_kehamilan'          => $this->input->post('status_kehamilan'),
            'penyakit_kronis_id'        => $this->input->post('penyakit_kronis_id'),
            'jenis_disabilitas_id'      => $this->input->post('jenis_disabilitas_id'),
            'apakah_perokok_id'         => $this->input->post('apakah_perokok_id'),
            'partisipasi_sekolah_id'    => $this->input->post('partisipasi_sekolah_id'),
            'jenjang_pendidikan_id'     => $this->input->post('jenjang_pendidikan_id'),
            'kelas_tertinggi'           => $this->input->post('kelas_tertinggi'),
            'ijazah_terakhir_id'        => $this->input->post('ijazah_terakhir_id'),
            'status_bekerja'            => $this->input->post('status_bekerja'),
            'lapangan_usaha_id'         => $this->input->post('lapangan_usaha_id'),
            'jabatan_pekerjaan_id'      => $this->input->post('jabatan_pekerjaan_id'),
            'status_anggota_ruta_id'    => $this->input->post('status_anggota_ruta_id'),
        );

        $query = $this->db->where("nik_anggota", $this->input->post("nik_anggota"))->get("main_keterangan_sosial_ekonomi")->result_array();

        if(count($query) >= 1) {
            $errors["nik_terdaftar"] = "Maaf, NIK sudah terdaftar";
        }

        if(empty($main_id)) {
            $errors['main_id'] = 'Server sibuk ! Mohon refresh browser anda terlebih dahulu !';
        }

        if(strlen($this->input->post('nik_anggota')) < 16) {
            $errors['nik_anggota'] = 'NIK harus berisi 16 digit angka';
        }

        if(empty($this->input->post('nama_anggota'))) {
            $errors['nama_anggota'] = 'Nama anggota keluarga tidak boleh kosong';
        }

        if(empty($this->input->post('hubungan_keluarga_id')) || empty($this->input->post('jenis_kelamin')) || empty($this->input->post('tanggal_lahir')) || empty($this->input->post('status_perkawinan_id')) || empty($this->input->post('partisipasi_sekolah_id')) || empty($this->input->post('status_bekerja')) || empty($this->input->post('status_anggota_ruta_id'))) {
            $errors['empty_message'] = 'Kolom input dengan tanda * tidak boleh kosong';
        }
        
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $insert = $this->db->insert('main_keterangan_sosial_ekonomi', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['main_id'] = $data["main_id"] = $this->key->crypts($main_id, 'e');
        }
        
        echo json_encode($data);
    }

    public function input5_create()
    {
        $errors = [];
        $data = [];

        $main_id = $this->input->post('main_id');
        $main_id = $this->key->crypts($main_id, 'd');

        $data_post = array(
            'main_id'           => $main_id,
            'tabung_gas_3kg'    => $this->input->post('tabung_gas_3kg'),
            'tabung_gas_5kg'    => $this->input->post('tabung_gas_5kg'),
            'tabung_gas_12kg'   => $this->input->post('tabung_gas_12kg'),
            'kulkas'            => $this->input->post('kulkas'),
            'ac'                => $this->input->post('ac'),
            'pemanas_air'       => $this->input->post('pemanas_air'),
            'telepon'           => $this->input->post('telepon'),
            'televisi_flat'     => $this->input->post('televisi_flat'),
            'perhiasan_10gr'    => $this->input->post('perhiasan_10gr'),
            'rekening_bank'     => $this->input->post('rekening_bank'),
            'komputer_laptop'   => $this->input->post('komputer_laptop'),
            'sepeda_motor'      => $this->input->post('sepeda_motor'),
            'mobil'             => $this->input->post('mobil'),
            'perahu'            => $this->input->post('perahu'),
            'perahu_motor'      => $this->input->post('perahu_motor'),

            'lahan'             => $this->input->post('lahan'),
            'lahan_luas'        => $this->input->post('lahan_luas'),
            'rumah_lain'        => $this->input->post('rumah_lain'),

            'sapi'              => $this->input->post('sapi'),
            'kerbau'            => $this->input->post('kerbau'),
            'kuda'              => $this->input->post('kuda'),
            'kambing'           => $this->input->post('kambing'),
            'unggas'            => $this->input->post('unggas'),
            'kelinci'           => $this->input->post('kelinci'),
            'perikanan'          => $this->input->post('perikanan'),

            'memiliki_usaha'    => $this->input->post('memiliki_usaha'),
            'estimasi_pengeluaran' => $this->input->post('estimasi_pengeluaran'),
            'estimasi_pengeluaran_non_makanan' => $this->input->post('estimasi_pengeluaran_non_makanan'),
        );

        if(empty($_POST['main_id'])) {
            $errors['main_id'] = 'Server sibuk ! Mohon refresh browser anda terlebih dahulu !';
        }
        
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $insert = $this->db->insert('main_aset', $data_post);

            if(isset($_POST['jenis_bantuan_id']) && $_POST['jenis_bantuan_id'] != "") {
                foreach($_POST['jenis_bantuan_id'] as $key => $value) {
                    $data_batch[] = array(
                        'main_id'           => $main_id,
                        'jenis_bantuan_id'  => $_POST['jenis_bantuan_id'][$key]
                    );
                }

                $insert_batch = $this->db->insert_batch('main_jenis_bantuan', $data_batch);
            }

            if(isset($_POST['nama_id']) && $_POST['main_id'] != "") {
                foreach($_POST['nama_id'] as $key => $value) {
                    $data_batch_usaha[] = array(
                        'main_id'           => $main_id,
                        'nama_id'           => $_POST['nama_id'][$key],
                        'lapangan_usaha_id' => $_POST['lapangan_usaha_id'][$key],
                        'pegawai_dibayar'   => $_POST['pegawai_dibayar'][$key],
                        'pegawai_tidak_dibayar' => $_POST['pegawai_tidak_dibayar'][$key],
                        'registrasi_usaha'  => $_POST['registrasi_usaha'][$key],
                        'omset_perbulan'    => $_POST['omset_perbulan'][$key],
                    );
                }

                $this->db->insert_batch('main_usaha_dimiliki', $data_batch_usaha);
            }

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['main_id'] = $data["main_id"] = $this->key->crypts($main_id, 'e');
        }
        
        echo json_encode($data);
    }

    public function input6_create()
    {
        $errors = [];
        $data = [];

        $main_id = $this->input->post('main_id');
        $main_id = $this->key->crypts($main_id, 'd');

        $location = FCPATH."/files/".$main_id;

        if(!file_exists($location)) {
            mkdir($location, 0777);
        }

        if(!$_FILES['files1']['error'] > 0) { 
            $foto1 = $this->upload_file($location, "files1");
        } else {
            $foto1 = "";
        }

        if(!$_FILES['files2']['error'] > 0) { 
            $foto2 = $this->upload_file($location, "files2");
        } else {
            $foto2 = "";
        }

        if(!$_FILES['files3']['error'] > 0) { 
            $foto3 = $this->upload_file($location, "files3");
        } else {
            $foto3 = "";
        }

        if(!$_FILES['files4']['error'] > 0) { 
            $foto4 = $this->upload_file($location, "files4");
        } else {
            $foto4 = "";
        }

        $data_post = array(
            'main_id'   => $main_id,
            'latitude'  => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'foto1'     => $foto1,
            'foto2'     => $foto2,
            'foto3'     => $foto3,
            'foto4'     => $foto4,
        );

        if(empty($this->input->post('main_id'))) {
            $errors['main_id'] = 'Server sibuk ! Mohon refresh browser anda terlebih dahulu !';
        }
        
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $insert = $this->db->insert('main_foto_lokasi', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['main_id'] = $data["main_id"] = $this->key->crypts($main_id, 'e');
        }
        
        echo json_encode($data);
    }

    private function upload_file($location, $file)
    {
        $config['upload_path']          = $location;
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = date("ymdhis").rand();
        // $config['overwrite']         = true;
        $config['max_size']             = 2048; // 2MB

        $this->load->library('upload', $config);

        $this->upload->do_upload($file);

        return $this->upload->data('file_name');
    }

    public function delete_input4()
    {
        $id      = $this->input->post('id');
        $main_id = $this->input->post('main_id');
        $main_id = $this->key->crypts($main_id, 'd');

        $this->db->delete("main_keterangan_sosial_ekonomi", ["id" => $id]);
        $data['main_id'] = $data["main_id"] = $this->key->crypts($main_id, 'e');
        
        echo json_encode($data);
    }
}
