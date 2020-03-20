<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Mahasiswa
 *
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Jefri Maruli <jefrimaruli@gmail.com>
 * @link      https://github.com/xietsunzao/
 *
 */
class Mahasiswa extends CI_Controller
{
    /**
     * __construct.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.1	Monday, November 18th, 2019.
     * @access	public
     * @return	void
     */
    public function __construct()
    {
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }        // load model
        $this->load->model('Mahasiswa_model', 'mhs');
    }

    /**
     * function index
     * untuk menampilkan halaman saat load class pertaa kali
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.1	Monday, November 18th, 2019.	
     * @version	v1.0.2	Tuesday, November 19th, 2019.	
     * @version	v1.0.3	Wednesday, November 20th, 2019.	
     * @version	v1.0.4	Thursday, November 21st, 2019.	
     * @version	v1.0.5	Sunday, November 24th, 2019.
     * @access	public
     * @return	mixed
     */
    public function index()
    {
        /**
         * @param	string	'btn  btn-gradient-success'	
         * @return	void
         */
        $attradd = array('class' => 'btn  btn-gradient-success');
        /**
         * $tambahdata.
         *
         * @param	string	'mahasiswa/add'                                    	
         * @param	string	'<i class="feather icon-user-plus"></i>Tambah Data'	
         * @param	mixed 	$attradd                                           	
         * @return	void
         */ /**
         * anonymouse class.
         *
         * @since	v0.0.1
         * @version	v1.0.0	Thursday, November 21st, 2019.
         */
        $tambahdata = anchor('mahasiswa/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        /**
         * @var		mixed	$this->mhs->lihat_data()
         */
        $mhs = $this->mhs->lihat_data();
        /**
         * @var		mixed	$data
         */
        $data = array(
            'mahasiswa' =>  $mhs,
            'title' => 'Data Mahasiswa',
            'btntambah' => $tambahdata,
        );
        $this->template->load('template/template_v', 'mahasiswa/mahasiswa_v', $data);
    }

    /**
     * detail.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.1	Sunday, November 24th, 2019.
     * @access	public
     * @param	mixed	$id	
     * @return	void
     */
    public function detail($id)
    {
        /**
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * @var		mixed	$this->mhs->get_row($id)
         */
        $get_row = $this->mhs->get_row($id);
        if ($get_row->num_rows() > 0) {
            /**
             * $row.
             *
             * @param	mixed	)->row(	
             * @return	void
             */
            $row = $get_row->row();
            /**
             * GET ROW
             *
             * @var		mixed	$row->id_mahasiswa
             */
            $id_mahasiswa = $row->id_mahasiswa;
            /**
             * @var		mixed	$row->nim
             */
            $nim = $row->nim;
            /**
             * @var		mixed	$row->nama_mhs
             */
            $nama_mhs = $row->nama_mhs;
            /**
             * @var		mixed	$row->id_prodi
             */
            $id_prodi = $row->id_prodi;
            /**
             * @var		mixed	$row->id_konsentrasi
             */
            $id_konsentrasi = $row->id_konsentrasi;
            /**
             * @var		mixed	$row->id_jenjang
             */
            $id_jenjang = $row->id_jenjang;
            /**
             * @var		mixed	$row->kode_prodi
             */
            $kode_prodi = $row->kode_prodi;
            /**
             * @var		mixed	$row->kode_konsentrasi
             */
            $kode_konsentrasi = $row->kode_konsentrasi;
            /**
             * @var		mixed	$row->kode_jenjang
             */
            $kode_jenjang = $row->kode_jenjang;
            /**
             * @var		mixed	$row->nama_prodi
             */
            $nama_prodi = $row->nama_prodi;
            /**
             * @var		mixed	$row->nama_konsentrasi
             */
            $nama_konsentrasi = $row->nama_konsentrasi;
            /**
             * @var		mixed	$row->nama_jenjang
             */
            $nama_jenjang = $row->nama_jenjang;
            /**
             * @var		mixed	$row->email
             */
            $email = $row->email;
            /**
             * @var		mixed	$row->no_telp
             */
            $no_telp = $row->no_telp;
            /**
             * $data.
             *
             * @author	Jeff Maruli <jefrimaruli@gmail.com>
             * @var		mixed	$data
             */
            $data = array(
                'title' => 'Detail Mahasiswa',
                'parent' => 'Data Mahasiswa',
                'id_mahasiswa' => $id_mahasiswa,
                'nim' => $nim,
                'nama_mhs' => $nama_mhs,
                'id_prodi' => $id_prodi,
                'id_konsentrasi' => $id_konsentrasi,
                'id_jenjang' => $id_jenjang,
                'kode_prodi' => $kode_prodi,
                'kode_jenjang' => $kode_jenjang,
                'kode_konsentrasi' => $kode_konsentrasi,
                'nama_prodi' => $nama_prodi,
                'nama_konsentrasi' => $nama_konsentrasi,
                'nama_jenjang' => $nama_jenjang,
                'email' => $email,
                'no_telp' => $no_telp,
            );
            $this->template->load('template/template_v', 'mahasiswa/mahasiswa_d', $data);
        } else {
            /**
             * @var		mixed	$this->session->set_flashdata('warning'
             */ /**
             * @var		mixed	!')
             */
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            /**
             * @var		mixed	redirect('mahasiswa')
             */
            redirect('mahasiswa');
        }
    }

    /**
     * Add a new item
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 18th, 2019.	
     * @version	v1.0.1	Monday, November 18th, 2019.	
     * @version	v1.0.2	Wednesday, November 20th, 2019.	
     * @version	v1.0.3	Friday, November 22nd, 2019.	
     * @version	v1.0.4	Saturday, November 23rd, 2019.	
     * @version	v1.0.5	Monday, November 25th, 2019.
     * @access	public
     * @return	mixed
     */
    public function add()
    {
        /**
         * ambil method dari model untuk menampilkan data prodi
         *
         * @var		mixed	$this->mhs->get_prodi()
         */
        $prodi = $this->mhs->get_prodi();
        /**
         * ambil method dari model untuk menampilkan data kosentrasi
         *
         * @var		mixed	$this->mhs->get_konsentrasi()
         */
        $konsentrasi = $this->mhs->get_konsentrasi();
        /**
         * ambil method dari model untuk menampilkan data jenjang
         *
         * @var		mixed	$this->mhs->get_jenjang()
         */
        $jenjang = $this->mhs->get_jenjang();

        /**
         * @var		mixed	$attrform
         */
        $attrform = array(
            'class' => 'needs-validation',
            'novalidate' => 'novalidate'
        );

        $action  = 'mahasiswa/addaction';
        /**
         * $form.
         *
         * @param	mixed	$action	
         * @return	void
         */
        $formopen = form_open($action, $attrform);
        /**
         * @var		mixed	$formclos
         */
        $formclose  = form_close();

        /**
         * label
         * label NIM
         * @param	string	'NIM'	
         * @param	string	'nim'	
         * @return	void
         */
        $lnim = form_label('NIM', 'nim');
        /**
         * $lnama_mhs.
         *. label nama mahasiswa 
         * @param	string	'Nama Mahasiswa'	
         * @param	string	'nama_mhs'      	
         * @return	void
         */
        $lnama_mhs = form_label('Nama Mahasiswa', 'nama_mhs');
        /**
         * $lprodi.
         * label program studi
         * @param	string	'Program Studi'	
         * @param	string	'prodi'        	
         * @return	void
         */
        $lprodi = form_label('Program Studi', 'prodi');
        /**
         * $lkonsentrasi.
         * label konsentrasi 
         * @param	string	'Konsentrasi'	
         * @param	string	'konsentrasi'	
         * @return	void
         */
        $lkonsentrasi = form_label('Konsentrasi', 'konsentrasi');
        /**
         * $ljenjang.
         *
         * @param	string	'Jenjang'	
         * @param	string	'jenjang'	
         * @return	void
         */
        $ljenjang = form_label('Jenjang', 'jenjang');
        /**
         * $lemail.
         *
         * @param	string	'email'	
         * @param	string	'email'	
         * @return	void
         */
        $lemail = form_label('Email', 'email');
        /**
         * $lno_telp.
         *
         * @param	string	'Nomor Telepon'	
         * @param	string	'no_telp'      	
         * @return	void
         */
        $lno_telp = form_label('Nomor Telepon', 'no_telp');

        // ATTRIBUTE INPUT TEXT 
        $attrid_mahasiswa = array(
            'type' => 'hidden',
            'name' => 'id_mahasiswa',
            'id' => 'id_mahasiswa',
            'value' => set_value('id_mahasiswa'),
            'required' => 'required'
        );
        /**
         * @var		mixed	$inim
         */
        $attrnim = array(
            'type' => 'text',
            'name' => 'nim',
            'id' => 'nim',
            'placeholder' => 'Masukkan nim',
            'value' => set_value('nim'),
            'class' => 'form-control nim',
            'required' => 'required'
        );

        /**
         * @var		mixed	$inama_mhs
         */
        $attrnama_mhs = array(
            'type' => 'text',
            'name' => 'nama_mhs',
            'id' => 'nama_mhs',
            'placeholder' => 'Masukkan Nama Mahasiswa',
            'value' => set_value('nama_mhs'),
            'class' => 'form-control',
            'required' => 'required'
        );

        /**
         * @var		mixed	$attremail
         */
        $attremail = array(
            'type' => 'email',
            'name' => 'email',
            'id' => 'email',
            'placeholder' => 'Masukkan Email',
            'class' => 'form-control',
            'value' => set_value('email'),
            'required' => 'required'

        );

        /**
         * @var		mixed	$attrno_telp
         */
        $attrno_telp = array(
            'type' => 'text',
            'name' => 'no_telp',
            'id' => 'no_telp',
            'placeholder' => 'Masukkan Nomor Telpon',
            'class' => 'form-control phone',
            'value' => set_value('no_telp'),
            'required' => 'required'
        );

        // DROP DOWN
        $getprd = $this->mhs->get_prodi();
        /**
         * $prodi.
         *
         * @return	void
         */
        $prodi = array();
        foreach ($getprd as $p) {
            $prodi[$p->id_prodi] = $p->nama_prodi;
        }

        /**
         * @var		mixed	$optprodi
         */
        $optprodi = array(
            'id' => 'prodi',
            'class' => 'form-control'
        );

        $getksn = $this->mhs->get_konsentrasi();
        /**
         * $konsentrasi.
         *

         * @return	void
         */
        $konsentrasi = array();
        foreach ($getksn as $k) {
            $konsentrasi[$k->id_konsentrasi] = $k->nama_konsentrasi;
        }

        /**
         * @var		mixed	$optkonsentasi
         */
        $optkonsentrasi = array(
            'id' => 'konsentrasi',
            'class' => 'form-control'
        );

        $getjng = $this->mhs->get_jenjang();
        /**
         * $jenjang.
         *
         * @return	void
         */
        $jenjang = array();
        foreach ($getjng as $j) {
            $jenjang[$j->id_jenjang] = $j->nama_jenjang;
        }

        /**
         * @var		mixed	$optjenjang
         */
        $optjenjang = array(
            'id' => 'jenjang',
            'class' => 'form-control'
        );

        /**
         * $ddprodi.
         *
         * @param	string	'prodi'           	
         * @param	mixed 	$prodi            	
         * @param	mixed 	set_value('prodi')	
         * @param	mixed 	$optprodi         	
         * @return	void
         */
        $ddprodi = form_dropdown('prodi', $prodi, set_value('prodi'), $optprodi);
        /**
         * $ddkonsentrasi.
         *
         * @param	string	'konsentrasi'           	
         * @param	mixed 	$konsentrasi            	
         * @param	mixed 	set_value('konsentrasi')	
         * @param	mixed 	$optkonsentrasi         	
         * @return	void
         */
        $ddkonsentrasi = form_dropdown('konsentrasi', $konsentrasi, set_value('konsentrasi'), $optkonsentrasi);
        /**
         * @var		mixed	$inputnim
         */
        /**
         * $ddjenjang.
         *
         * @param	string	'jenjang'           	
         * @param	mixed 	$jenjang            	
         * @param	mixed 	set_value('jenjang')	
         * @param	mixed 	$optjenjang         	
         * @return	void
         */
        $ddjenjang = form_dropdown('jenjang', $jenjang, set_value('jenjang'), $optjenjang);

        // FORM INPUT

        /**
         * $inputid_mahasiswa.
         *
         * @param	mixed	$attrid_mahasiswa	
         * @return	void
         */
        $inputid_mahasiswa = form_input($attrid_mahasiswa);
        /**
         * $inputnim.
         *
         * @param	mixed	$attrnim	
         * @return	void
         */
        $inputnim = form_input($attrnim);
        /**
         * $inputnama.
         * @param	mixed	$inama_mhs	
         * @return	void
         */
        $inputnama_mhs = form_input($attrnama_mhs);
        /**
         * $inputemail.
         *
         * @param	mixed	$attremail	
         * @return	void
         */
        $inputemail = form_input($attremail);

        /**
         * $inputno_telp.
         *.
         * @param	mixed	$attrno_telp	
         * @return	void
         */
        $inputno_telp = form_input($attrno_telp);
        /**
         * @var		mixed	$attrsubmit
         */
        $attrsubmit = array(
            'id' => 'submit',
            'class' => 'btn btn-gradient-info'
        );

        /**
         * FORM ERROR TEXT INPUT
         *
         * @param	string	'nim'	
         * @return	void
         */
        $fe_nim = form_error('nim');
        /**
         * $fe_namamhs.
         *
         * @param	string	'nama_mhs'	
         * @return	void
         */
        $fe_namamhs = form_error('nama_mhs');

        /**
         * $fe_email.
         *
         * @param	string	'email'	
         * @return	void
         */
        $fe_email = form_error('email');

        /**
         * $fe_notelp.
         *
         * @param	string	'no_telp'	
         * @return	void
         */
        $fe_notelp = form_error('no_telp');

        /**
         * INVALID FEEDBACKS
         *
         * @var		string	$ivnim
         */
        $ivnim = 'NIM harus diisi!';
        /**
         * @var		string	$ivnama_mhs
         */
        $ivnama_mhs = 'Nama harus diisi!';
        /**
         * @var		string	$ivemail
         */
        $ivemail = 'Email harus diisi!';
        /**
         * @var		string	$ivnotelp
         */
        $ivnotelp = 'No telepon harus diisi!';
        /**
         * $submit.
         * .
         * @param	string	'sumbit'   	
         * @param	string	'Simpan'   	
         * @param	mixed 	$attrsubmit	
         * @return	void
         */
        $submit = form_submit('submit', 'Simpan', $attrsubmit);
        /**
         * @var		mixed	$data
         */
        $data = array(
            'formopen' => $formopen,
            'formclose' => $formclose,
            'prodi' => $prodi,
            'parent' => 'Data Mahasiswa',
            'title' => 'Tambah Mahasiswa',
            'konsentrasi' => $konsentrasi,
            'jenjang' => $jenjang,
            'lnim' => $lnim,
            'lnama_mhs' => $lnama_mhs,
            'lprodi' => $lprodi,
            'lkonsentrasi' => $lkonsentrasi,
            'ljenjang' => $ljenjang,
            'lemail' => $lemail,
            'lno_telp' => $lno_telp,
            'inputid' => $inputid_mahasiswa,
            'inputnim' => $inputnim,
            'inputnama_mhs' => $inputnama_mhs,
            'iemail' => $inputemail,
            'inputno_telp' => $inputno_telp,
            'ddprodi' => $ddprodi,
            'ddkonsentrasi' => $ddkonsentrasi,
            'ddjenjang' => $ddjenjang,
            'fe_nim' => $fe_nim,
            'fe_namamhs' => $fe_namamhs,
            'fe_email' => $fe_email,
            'fe_notelp' => $fe_notelp,
            'ivnim' => $ivnim,
            'ivnama_mhs' => $ivnama_mhs,
            'ivemail' => $ivemail,
            'ivnotelp' => $ivnotelp,
            'submit' => $submit
        );
        $this->template->load('template/template_v', 'mahasiswa/mahasiswa_form', $data);
    }
    /**
     * addaction.
     * proses menambahkan data jika data form diisi!
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 18th, 2019.	
     * @version	v1.0.1	Monday, November 18th, 2019.	
     * @version	v1.0.2	Wednesday, November 20th, 2019.	
     * @version	v1.0.3	Sunday, November 24th, 2019.
     * @access	public
     * @return	void
     */
    public function addaction()
    {
        $this->_rules();
        $validation = $this->form_validation->run();
        if ($validation == FALSE) {
            $this->add();
        } else {
            // POST DATA
            /**
             * @var		mixed	$this->input->post('nim'
             */ /**
             * @var		mixed	TRUE)
             */
            $nim =  $this->input->post('nim', TRUE);
            /**
             * @var		mixed	$this->input->post('nama_mhs'
             */ /**
             * @var		mixed	TRUE)
             */
            $nama_mhs = $this->input->post('nama_mhs', TRUE);
            /**
             * @var		mixed	$this->input->post('prodi'
             */ /**
             * @var		mixed	TRUE)
             */
            $prodi = $this->input->post('prodi', TRUE);
            /**
             * @var		mixed	$this->input->post('konsentrasi'
             */ /**
             * @var		mixed	TRUE)
             */
            $konsentrasi = $this->input->post('konsentrasi', TRUE);
            /**
             * @var		mixed	$this->input->post('jenjang'
             */ /**
             * @var		mixed	TRUE)
             */
            $jenjang = $this->input->post('jenjang', TRUE);
            /**
             * @var		mixed	$this->input->post('email'
             */ /**
             * @var		mixed	TRUE)
             */
            $email = $this->input->post('email', TRUE);
            /**
             * @var		mixed	$this->input->post('no_telp'
             */ /**
             * @var		mixed	TRUE)
             */
            $no_telp = $this->input->post('no_telp', TRUE);
            /**
             * $notelp.
             *
             * @param	string	'-'     	
             * @param	string	''      	
             * @param	mixed 	$no_telp	
             * @return	void
             */
            $notelp = str_replace('-', '', $no_telp);
            $data = array(
                'nim' => $nim,
                'nama_mhs' => $nama_mhs,
                'id_prodi' => $prodi,
                'id_konsentrasi' => $konsentrasi,
                'id_jenjang' => $jenjang,
                'email' => $email,
                'no_telp' => $notelp,
            );
            /**
             * @var		mixed	$this->mhs->insert_data($data)
             */
            $this->mhs->insert_data($data);
            /**
             * @var		mixed	$this->session->set_flashdata('success'
             */ /**
             * @var		data	berhasil
             */
            $this->session->set_flashdata('success', 'Data berhasil disimpan');

            /**
             * @var		mixed	redirect('mahasiswa'
             */ /**
             * @var		mixed	refresh')
             */
            redirect('mahasiswa', 'refresh');
        }
    }
    /**
     * Update one item
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 18th, 2019.	
     * @version	v1.0.1	Wednesday, November 20th, 2019.	
     * @version	v1.0.2	Friday, November 22nd, 2019.	
     * @version	v1.0.3	Saturday, November 23rd, 2019.
     * @access	public
     * @param	mixed	$id	Default: NULL
     * @return	void
     */
    public function update($id = NULL)
    {
        /**
         * set segment
         *
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * pemanggilan method get_row di Mahasiswa_model
         *
         * @var		mixed	$this->mhs->get_row($id)
         */
        $cek_row = $this->mhs->get_row($id);
        /**
         * ambil method dari model untuk menampilkan data prodi
         *
         * @var		mixed	$this->mhs->get_prodi()
         */
        $prodi = $this->mhs->get_prodi();
        /**
         * ambil method dari model untuk menampilkan data kosentrasi
         *
         * @var		mixed	$this->mhs->get_konsentrasi()
         */
        $konsentrasi = $this->mhs->get_konsentrasi();
        /**
         * ambil method dari model untuk menampilkan data jenjang
         *
         * @var		mixed	$this->mhs->get_jenjang()
         */

        $jenjang = $this->mhs->get_jenjang();
        if ($cek_row->num_rows() > 0) {
            /**
             * data yang di return berupa row()
             * @var		mixed	$cek_row->row()
             */
            $row = $cek_row->row();

            // value dari nilai yang di return oleh variable row()
            /**
             * @var		mixed	$row->id_mahasiswa
             */
            $id_mahasiswa = $row->id_mahasiswa;
            /**
             * @var		mixed	$row->nim
             */
            $nim = $row->nim;
            /**
             * @var		mixed	$row->nama_mhs
             */
            $nama_mhs = $row->nama_mhs;
            /**
             * @var		mixed	$row->id_prodi
             */
            $id_prodi = $row->id_prodi;
            /**
             * @var		mixed	$row->id_konsentrasi
             */
            $id_konsentrasi = $row->id_konsentrasi;
            /**
             * @var		mixed	$row->id_jenjang
             */
            $id_jenjang = $row->id_jenjang;
            /**
             * @var		mixed	$row->email
             */
            $email = $row->email;
            /**
             * @var		mixed	$row->no_telp
             */
            $no_telp = $row->no_telp;

            // membuat form 

            $attrform = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );
            /**
             * @var		string	$action
             */
            $action = 'mahasiswa/updateaction';
            /**
             * $form.
             *
             * @param	mixed	$action	
             * @return	void
             */
            $formopen = form_open($action, $attrform);
            /**
             * $formclose.
             *
             * @return	void
             */
            $formclose = form_close();
            /**
             * label
             * label NIM
             * @param	string	'NIM'	
             * @param	string	'nim'	
             * @return	void
             */
            $lnim = form_label('NIM', 'nim');
            /**
             * $lnama_mhs.
             *. label nama mahasiswa 
             * @param	string	'Nama Mahasiswa'	
             * @param	string	'nama_mhs'      	
             * @return	void
             */
            $lnama_mhs = form_label('Nama Mahasiswa', 'nama_mhs');
            /**
             * $lprodi.
             * label program studi
             * @param	string	'Program Studi'	
             * @param	string	'prodi'        	
             * @return	void
             */
            $lprodi = form_label('Program Studi', 'prodi');
            /**
             * $lkonsentrasi.
             * label konsentrasi 
             * @param	string	'Konsentrasi'	
             * @param	string	'konsentrasi'	
             * @return	void
             */
            $lkonsentrasi = form_label('Konsentrasi', 'konsentrasi');
            /**
             * $ljenjang.
             *
             * @param	string	'Jenjang'	
             * @param	string	'jenjang'	
             * @return	void
             */
            $ljenjang = form_label('Jenjang', 'jenjang');
            /**
             * $lemail.
             *  
             * @param	string	'email'	
             * @param	string	'email'	
             * @return	void
             */
            $lemail = form_label('Email', 'email');

            /**
             * $lno_telp.
             * @param	string	'Nomo Telepon'	
             * @param	string	'no_telp'     	
             * @return	void
             */
            $lno_telp = form_label('Nomo Telepon', 'no_telp');
            // ATTRIBUTE INPUT TEXT     

            /**
             * @var		mixed	$attrid_mahasiswa
             * 
             */
            $attrid_mahasiswa = array(
                'type' => 'hidden',
                'name' => 'id_mahasiswa',
                'id' => 'id_mahasiswa',
                'value' => set_value('id_mahasiswa', $id_mahasiswa),
                'class' => 'form-control',

            );

            /**
             * @var		mixed	$inim
             */
            $attrnim = array(
                'type' => 'text',
                'name' => 'nim',
                'id' => 'nim',
                'placeholder' => 'Masukkan nim',
                'value' => set_value('nim', $nim),
                'class' => 'form-control nim',
                'required' => 'required'
            );

            /**
             * @var		mixed	$inama_mhs
             */
            $attrnama_mhs = array(
                'type' => 'text',
                'name' => 'nama_mhs',
                'id' => 'nama_mhs',
                'placeholder' => 'Masukkan Nama Mahasiswa',
                'value' => set_value('nama_mhs', $nama_mhs),
                'class' => 'form-control',
                'required' => 'required'
            );
            /**
             * @var		mixed	$attremail
             */
            $attremail = array(
                'type' => 'email',
                'name' => 'email',
                'id' => 'email',
                'placeholder' => 'Masukkan Email',
                'value' => set_value('email', $email),
                'class' => 'form-control',
                'required' => 'required'
            );

            /**
             * @var		mixed	$attrno_telp
             */
            $attrno_telp = array(
                'type' => 'text',
                'name' => 'no_telp',
                'id' => 'no_telp',
                'placeholder' => 'Masukkan No Telepon',
                'value' => set_value('no_telp', $no_telp),
                'class' => 'form-control .phone',
                'required' => 'required'
            );

            /**
             * di urutkan menjadi nilai array
             * @var		mixed	$data
             */

            // DROP DOWN
            $getprd = $this->mhs->get_prodi();
            /**
             * $prodi.
             *
             * @return	void
             */
            $prodi = array();
            foreach ($getprd as $p) {
                $prodi[$p->id_prodi] = $p->nama_prodi;
            }

            /**
             * @var		mixed	$optprodi
             */
            $optprodi = array(
                'id' => 'prodi',
                'class' => 'form-control'
            );

            $getksn = $this->mhs->get_konsentrasi();
            /**
             * $konsentrasi.
             *

             * @return	void
             */
            $konsentrasi = array();
            foreach ($getksn as $k) {
                $konsentrasi[$k->id_konsentrasi] = $k->nama_konsentrasi;
            }

            /**
             * @var		mixed	$optkonsentasi
             */
            $optkonsentrasi = array(
                'id' => 'konsentrasi',
                'class' => 'form-control'
            );

            $getjng = $this->mhs->get_jenjang();
            /**
             * $jenjang.
             *
             * @return	void
             */
            $jenjang = array();
            foreach ($getjng as $j) {
                $jenjang[$j->id_jenjang] = $j->nama_jenjang;
            }

            /**
             * @var		mixed	$optjenjang
             */
            $optjenjang = array(
                'id' => 'jenjang',
                'class' => 'form-control'
            );

            /**
             * $ddprodi.
             *
             * @param	string	'prodi'           	
             * @param	mixed 	$prodi            	
             * @param	mixed 	set_value('prodi')	
             * @param	mixed 	$optprodi         	
             * @return	void
             */
            $ddprodi = form_dropdown('prodi', $prodi, set_value('prodi', $id_prodi), $optprodi);
            /**
             * $ddkonsentrasi.
             *
             * @param	string	'konsentrasi'           	
             * @param	mixed 	$konsentrasi            	
             * @param	mixed 	set_value('konsentrasi')	
             * @param	mixed 	$optkonsentrasi         	
             * @return	void
             */
            $ddkonsentrasi = form_dropdown('konsentrasi', $konsentrasi, set_value('konsentrasi', $id_konsentrasi), $optkonsentrasi);
            /**
             * @var		mixed	$inputnim
             */
            /**
             * $ddjenjang.
             *
             * @param	string	'jenjang'           	
             * @param	mixed 	$jenjang            	
             * @param	mixed 	set_value('jenjang')	
             * @param	mixed 	$optjenjang         	
             * @return	void
             */
            $ddjenjang = form_dropdown('jenjang', $jenjang, set_value('jenjang', $id_jenjang), $optjenjang);
            /**
             * $inputnim.
             *
             * @param	mixed	$attrnim	
             * @return	void
             */

            // FORM INPUT
            /**
             * $inputnim.
             *
             * @param	mixed	$attrnim	
             * @return	void
             */
            $inputnim = form_input($attrnim);
            /**
             * $inputnama.
             * @param	mixed	$inama_mhs	
             * @return	void
             */
            $inputnama_mhs = form_input($attrnama_mhs);
            /**
             * $inputemail.
             *
             * @param	mixed	$attremail	
             * @return	void
             */
            $inputemail = form_input($attremail);

            /**
             * $inputid_mahasiswa.
             *
             * @param	mixed	$attrid_mahasiswa	
             * @return	void
             */
            $inputid_mahasiswa = form_input($attrid_mahasiswa);

            /**
             * $inputno_telp.
             *
             * @param	mixed	$attrno_telp	
             * @return	void
             */
            $inputno_telp = form_input($attrno_telp);
            /**
             * @var		mixed	$attrsubmit
             */
            $attrsubmit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            /**
             * FORM ERROR TEXT INPUT
             *
             * @param	string	'nim'	
             * @return	void
             */
            $fe_nim = form_error('nim');
            /**
             * $fe_namamhs.
             *
             * @param	string	'nama_mhs'	
             * @return	void
             */
            $fe_namamhs = form_error('nama_mhs');
            /**
             * $fe_email.
             *
             * @param	string	'email'	
             * @return	void
             */
            $fe_email = form_error('email');
            /**
             * $fe_notelp.
             *
             * @param	string	'no_telp'	
             * @return	void
             */
            $fe_notelp = form_error('no_telp');
            /**
             * $submit.
             * .
             * @param	string	'sumbit'   	
             * @param	string	'Simpan'   	
             * @param	mixed 	$attrsubmit	
             * @return	void
             */

            $submit = form_submit('submit', 'Simpan', $attrsubmit);
            /**
             * INVALID FEEDBACKS
             *
             * @var		string	$ivnim
             */
            $ivnim = 'NIM harus diisi!';
            /**
             * @var		string	$ivnama_mhs
             */
            $ivnama_mhs = 'Nama harus diisi!';
            /**
             * @var		string	$ivemail
             */
            $ivemail = 'Email harus diisi!';
            /**
             * @var		string	$ivnotelp
             */
            $ivnotelp = 'No telepon harus diisi!';
            /**
             * @var		mixed	$data
             */
            $data = array(
                'formopen' => $formopen,
                'formclose' => $formclose,
                'prodi' => $prodi,
                'parent' => 'Data Mahasiswa',
                'title' => 'Update Mahasiswa',
                'konsentrasi' => $konsentrasi,
                'jenjang' => $jenjang,
                'lnim' => $lnim,
                'lnama_mhs' => $lnama_mhs,
                'lprodi' => $lprodi,
                'lkonsentrasi' => $lkonsentrasi,
                'ljenjang' => $ljenjang,
                'lemail' => $lemail,
                'lno_telp' => $lno_telp,
                'inputid' => $inputid_mahasiswa,
                'inputnim' => $inputnim,
                'inputnama_mhs' => $inputnama_mhs,
                'inama_mhs' => $inputnama_mhs,
                'iemail' => $inputemail,
                'inputno_telp' => $inputno_telp,
                'ddprodi' => $ddprodi,
                'ddkonsentrasi' => $ddkonsentrasi,
                'ddjenjang' => $ddjenjang,
                'fe_nim' => $fe_nim,
                'fe_namamhs' => $fe_namamhs,
                'fe_email' => $fe_email,
                'fe_notelp' => $fe_notelp,
                'ivnim' => $ivnim,
                'ivnama_mhs' => $ivnama_mhs,
                'ivemail' => $ivemail,
                'ivnotelp' => $ivnotelp,
                'submit' => $submit
            );
            $this->template->load('template/template_v', 'mahasiswa/mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            /**
             * @var		mixed	redirect('mahasiswa')
             */
            redirect('mahasiswa');
        }
    }

    /**
     * updateaction.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 18th, 2019.	
     * @version	v1.0.1	Wednesday, November 20th, 2019.	
     * @version	v1.0.2	Sunday, November 24th, 2019.
     * @access	public
     * @return	void
     */
    public function updateaction()
    {
        $this->_rules();
        /**
         * deklarasi variable form validation
         * @var		mixed	$this->form_validation->run()
         */
        $validation = $this->form_validation->run();
        /**
         * @var		mixed	$validation
         */
        if ($validation == FALSE) {
            $this->update();
        } else {
            // POST DATA
            /**
             * @var		mixed	$this->input->post('id_mahasiswa'
             */ /**
             * @var		mixed	TRUE)
             */
            $id = $this->input->post('id_mahasiswa', TRUE);
            /**
             * @var		mixed	$this->input->post('nim'
             */ /**
             * @var		mixed	TRUE)
             */
            $nim =  $this->input->post('nim', TRUE);
            /**
             * @var		mixed	$this->input->post('nama_mhs'
             */ /**
             * @var		mixed	TRUE)
             */
            $nama_mhs = $this->input->post('nama_mhs', TRUE);
            /**
             * @var		mixed	$this->input->post('prodi'
             */ /**
             * @var		mixed	TRUE)
             */
            $prodi = $this->input->post('prodi', TRUE);
            /**
             * @var		mixed	$this->input->post('konsentrasi'
             */ /**
             * @var		mixed	TRUE)
             */
            $konsentrasi = $this->input->post('konsentrasi', TRUE);
            /**
             * @var		mixed	$this->input->post('jenjang'
             */ /**
             * @var		mixed	TRUE)
             */
            $jenjang = $this->input->post('jenjang', TRUE);
            /**
             * @var		mixed	$this->input->post('email'
             */ /**
             * @var		mixed	TRUE)
             */
            $email = $this->input->post('email', TRUE);
            /**
             * @var		mixed	$this->input->post('no_telp'
             */ /**
             * @var		mixed	TRUE)
             */
            $no_telp = $this->input->post('no_telp', TRUE);

            /**
             * @var		mixed	$data
             */
            $data = array(
                'id_mahasiswa' => $id,
                'nim' => $nim,
                'nama_mhs' => $nama_mhs,
                'id_prodi' => $prodi,
                'id_konsentrasi' => $konsentrasi,
                'id_jenjang' => $jenjang,
                'email' => $email,
                'no_telp' => $no_telp,
            );
            /**
             * pemanggilan model untuk update data
             * @var		mixed	$this->mhs->update_data($id
             */ /**
             * @var		mixed	$data)
             */
            $this->mhs->update_data($id, $data);
            /**
             * @var		mixed	$this->session->set_flashdata('success'
             */ /**
             * @var		data	berhasi
             */
            $this->session->set_flashdata('success', 'Data berhasil diubah');

            /**
             * @var		mixed	redirect('mahasiswa'
             */ /**
             * @var		mixed	refresh')
             */
            redirect('mahasiswa', 'refresh');
        }
    }

    /**
     * menghapus data
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.1	Monday, November 18th, 2019.
     * @access	public
     * @param	mixed	$id	Default: NULL
     * @return	void
     */
    public function delete($id)
    {
        /**
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * Panggil method Model untuk menghapus data
         * @var		mixed	$this->mhs->delete_data($id)
         */
        $this->mhs->delete_data($id);
        /**
         * @var		mixed	redirect('mahasiswa'
         */ /**
         * @var		mixed	refresh')
         */
        redirect('mahasiswa', 'refresh');
    }
    /**
     * _rules.
     * konfigurasi aturan dalam form validation
     * untuk mencegah kesalahan dala proses inputan data
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.1	Monday, November 18th, 2019.	
     * @version	v1.0.2	Wednesday, November 20th, 2019.	
     * @version	v1.0.3	Saturday, November 23rd, 2019.
     * @access	public
     * @return	void
     */
    public function _rules()
    {
        /**
         * @var		mixed	$attrnim
         */
        $attrnim = array(
            'required' => 'NIM harus diisi!',
            'min_length' => 'NIM minimal 8 karakter!',
            'max_length' => 'NIM melebihi 8 karakter!',
            'numeric' => 'NIM tidak menggunakan huruf!'
        );

        /**
         * @var		mixed	$attrnama_mhs
         */
        $attrnama_mhs = array(
            'required' => 'Nama mahasiswa harus diisi!',
            'min_length' => 'Nama mahasiswa minimal 5 karakter!',
            'max_length' => 'Nama mahasiswa maksimal 50 karakter!',
        );
        /**
         * @var		mixed	$attremail
         */
        $attremail = array(
            'required' => 'Email harus diisi!',
            'valid_email' => 'Masukkan email yang valid!'
        );

        /**
         * @var		mixed	$attrno_telp
         */
        $attrno_telp = array(
            'required' => 'Nomor Telepon harus diisi!',
            'min_length' => 'Nomor Telepon minimal 12 karakter!',
            'max_length' => 'Nomor Telepon tidak boleh melebihi 12 karakter!',
        );
        // mengatur form validasi
        $this->form_validation->set_rules('nim', 'NIM', 'trim|required|numeric|min_length[8]|max_length[8]', $attrnim);
        $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required|min_length[5]|max_length[50]', $attrnama_mhs);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', $attremail);
        $this->form_validation->set_rules('no_telp', 'Nomor Telep', 'trim|required|min_length[5]|max_length[15]', $attrno_telp);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}


/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
