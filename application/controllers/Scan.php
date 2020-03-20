<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Scan
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Jefri Maruli <jefrimaruli@gmail.com>
 * @link      https://github.com/xietsunzao/
 * @param     ...
 * @return    ...
 *
 */

class Scan extends CI_Controller
{

    /**
     * __construct.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 28th, 2019.
     * @access	public
     * @return	void
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }
        $this->load->model(
            [
                'Seminar_model' => 'sm',
                'Scan_model' => 'sc',
            ]
        );
    }


    public function index()
    {
        $title = 'Data Pendaftaran';
        $get_seminar = $this->sm->get_data();
        $data = array(
            'title' => $title,
            'seminar' => $get_seminar,
        );
        $this->template->load('template/template_v', 'scan/scan_v', $data);
    }

    /**
     * index.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 28th, 2019.
     * @access	public
     * @return	void
     */
    public function webcam($id)
    {
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $attradd = array('class' => 'btn  btn-gradient-success');
            $tambahdata = anchor("pendaftaran/add/{$id_seminar}", "<i class='feather icon-user-plus'></i>Tambah Data", $attradd);
            $nama_seminar = $row->nama_seminar;
            $title = "Scan Pendaftaran {$nama_seminar}";
            $data = array(
                'title' => $title,
                'btnadd' => $tambahdata,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
            );
            $this->template->load('template/template_v', 'scan/scan_desktop_v', $data);
        } else {
            redirect('pendaftaran');
        }
    }

    /**
     * proses_kehadiran.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 28th, 2019.
     * @access	public
     * @return	void
     */
    public function proses_kehadiran()
    {
        $id = $this->input->post('id');
        $seminar =  $this->input->post('seminar');
        $tgl = date('Y-m-d');
        $jam = date('h:i:s');
        $cek_id = $this->sc->cek_id($id);
        $cek_khd = $this->sc->cek_khd($id, $seminar);
        if (!$cek_id) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tidak Ditemukan!</div>');
            $this->load->view('scan/empty_v');
        } else if ($cek_khd && $cek_khd->id_stskhd == 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Sudah Melakukan Presensi!</div>');
            $nomor_induk = $cek_khd->nim;
            $prodi = $cek_khd->nama_prodi;
            $konsentrasi = $cek_khd->nama_konsentrasi;
            $jenjang = $cek_khd->nama_jenjang;
            $nama_mhs = $cek_khd->nama_mhs;
            $email = $cek_khd->email;
            $no_telp = $cek_khd->no_telp;
            $row = array(
                'nomor_induk' => $nomor_induk,
                'tgl_khd' => $tgl,
                'jam_khd' => $jam,
                'prodi' => $prodi,
                'konsentrasi' => $konsentrasi,
                'jenjang' => $jenjang,
                'nama_mhs' => $nama_mhs,
                'email' => $email,
                'no_telp' => $no_telp,
            );
            $this->load->view('scan/scan_result_v', $row);
        } else {
            $id_mahasiswa = $cek_id->id_mahasiswa;
            $nomor_induk = $cek_id->nim;
            $prodi = $cek_id->nama_prodi;
            $konsentrasi = $cek_id->nama_konsentrasi;
            $jenjang = $cek_id->nama_jenjang;
            $nama_mhs = $cek_id->nama_mhs;
            $email = $cek_id->email;
            $no_telp = $cek_id->no_telp;
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nomor_induk' => $nomor_induk,
                'id_seminar' => $seminar,
                'tgl_khd' => $tgl,
                'jam_khd' => $jam,
                'id_stskhd' => 2,
            );

            $row = array(
                'nomor_induk' => $nomor_induk,
                'tgl_khd' => $tgl,
                'jam_khd' => $jam,
                'prodi' => $prodi,
                'konsentrasi' => $konsentrasi,
                'jenjang' => $jenjang,
                'nama_mhs' => $nama_mhs,
                'email' => $email,
                'no_telp' => $no_telp,
            );

            $this->sc->insert_data($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat Datang!</div>');
            $this->load->view('scan/scan_result_v', $row);
        }
    }
}


/* End of file Scan.php */
/* Location: ./application/controllers/Scan.php */
