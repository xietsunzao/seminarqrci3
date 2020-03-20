<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }        $this->load->model(
            [
                'Pendaftaran_model' => 'pf',
                'Seminar_model' => 'sm',
                'Mahasiswa_model' => 'mhs',
                'Laporan_model' => 'lp',
            ]
        );
        $this->load->library('user_agent');
    }

    public function index()
    {
        $title = 'Laporan Presensi Seminar';
        $get_seminar = $this->sm->get_data();
        $data = array(
            'title' => $title,
            'seminar' => $get_seminar,
        );
        $this->template->load('template/template_v', 'laporan/laporan_v', $data);
    }

    public function detail($id)
    {
        $cu = current_url();
        $url = array(
            'link' => $cu
        );
        $this->session->set_userdata($url);
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $attradd = array('class' => 'btn  btn-gradient-success');
            $tambahdata = anchor("laporan/add/{$id_seminar}", "<i class='feather icon-user-plus'></i>Tambah Data", $attradd);
            $nama_seminar = $row->nama_seminar;
            $title = "Laporan Presensi Seminar {$nama_seminar}";
            $peserta = $this->mhs->lihat_data();
            $pendaftaran = $this->pf->get_data($id_seminar);
            // rekap
            $laporan = $this->lp->get_pst();
            $data = array(
                'title' => $title,
                'btnadd' => $tambahdata,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
                'pendaftaran' => $pendaftaran,
                'peserta' => $peserta,
                'laporan' => $laporan,
            );
            $this->template->load('template/template_v', 'laporan/laporan_d', $data);
        } else {
            redirect('pendaftaran');
        }
    }

    public function add($id)
    {
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $nama_seminar = $row->nama_seminar;
            $title = "Tambah Data Kehadiran Peserta";
            $parent = "Kehadiran Peserta Seminar";
            $form = "Formulir Kehadiran Peserta Seminar {$nama_seminar}";
            $attrform = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );
            $attr_seminar = array(
                'type' => 'hidden',
                'name' => 'seminar',
                'value' => set_value('seminar', $id_seminar)
            );
            $attr_peserta = array(
                'name' => 'peserta',
                'id' => 'peserta',
                'class' => 'js-example-basic-single form-control',
                'value' => set_value('peserta'),
            );
            $attrsubmit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );
            $attr_id = array(
                'type' => 'hidden',
                'name' => 'id_presensi',
                'id' => 'id_presensi',
                'value' => set_value('id_presensi'),
            );
            $get_peserta = $this->lp->get_p();
            $label_peserta = form_label('Peserta', 'peserta');
            $action  = 'laporan/addaction';
            $formopen = form_open($action, $attrform);
            $formclose = form_close();
            $peserta = array();
            foreach ($get_peserta as $p) {
                $peserta[$p->id_mahasiswa] = $p->nama_mhs . " ({$p->email})";
            }
            $input_id = form_input($attr_id);
            $input_seminar = form_input($attr_seminar);
            $ddpeserta = form_dropdown('peserta', $peserta, set_value('peserta'), $attr_peserta);
            $submit = form_submit('submit', 'Simpan', $attrsubmit);
            $data = array(
                'title' => $title,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
                'get_peserta' => $get_peserta,
                'parent' => $parent,
                'formopen' => $formopen,
                'formclose' => $formclose,
                'form' => $form,
                'label_peserta' => $label_peserta,
                'ddpeserta' => $ddpeserta,
                'inputid' => $input_id,
                'input_seminar' => $input_seminar,
                'submit' => $submit,
            );
            $this->template->load('template/template_v', 'laporan/laporan_form', $data);
        } else {
            $this->session->set_flashdata('danger', 'Data tidak ditemukan!');
            redirect('laporan');
        }
    }

    public function addaction()
    {
        $seminar = $this->input->post('seminar');
        $peserta = $this->input->post('peserta');
        $cek_peserta = $this->lp->get_presensi($peserta, $seminar);
        if ($cek_peserta->num_rows() > 0) {
            $refer =  $this->agent->referrer();
            if ($this->agent->is_referral()) {
                $refer =  $this->agent->referrer();
            }
            $row = $cek_peserta->row();
            $nama_peserta = $row->nama_mhs;
            $this->session->set_flashdata("warning", "Peserta {$nama_peserta} sudah hadir!");
            redirect($refer, 'refresh');
        } else {
            $cek_nim = $this->mhs->get_row($peserta);
            $nomor_induk = $cek_nim->row()->nim;
            $tgl = date('Y-m-d');
            $jam = date('h:i:s');
            $sts_khd = 2;
            $data = array(
                'id_mahasiswa' => $peserta,
                'nomor_induk' => $nomor_induk,
                'id_seminar' => $seminar,
                'tgl_khd' => $tgl,
                'jam_khd' => $jam,
                'id_stskhd' => $sts_khd,
            );
            $this->lp->insert_data($data);
            $this->session->set_flashdata('success', 'Data Presensi berhasil disimpan!');
            redirect('laporan');
        }
    }

    public function update($id)
    {
        $get_row = $this->lp->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $nama_seminar = $row->nama_seminar;
            $id_peserta = $row->id_mahasiswa;
            $id_presensi = $row->id_presensi;
            $title = "Edit Data Pendaftaran";
            $parent = "Pendaftaran Seminar";
            $form = "Formulir Pendaftaran Seminar {$nama_seminar}";

            $attrform = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );
            $attr_seminar = array(
                'type' => 'hidden',
                'name' => 'seminar',
                'value' => set_value('seminar', $id_seminar)
            );
            $attr_peserta = array(
                'name' => 'peserta',
                'id' => 'peserta',
                'class' => 'js-example-basic-single form-control',
            );
            $attrsubmit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );
            $attr_id = array(
                'type' => 'hidden',
                'name' => 'id_presensi',
                'id' => 'id_presensi',
                'value' => set_value('id_presensi', $id_presensi),
            );
            $get_peserta = $this->lp->get_p();
            $label_peserta = form_label('Peserta', 'peserta');
            $action  = 'laporan/editaction';
            $formopen = form_open($action, $attrform);
            $formclose = form_close();
            $peserta = array();
            foreach ($get_peserta as $p) {
                $peserta[$p->id_mahasiswa] = $p->nama_mhs . " ({$p->email})";
            }
            $input_id = form_input($attr_id);
            $input_seminar = form_input($attr_seminar);
            $ddpeserta = form_dropdown('peserta', $peserta, set_value('peserta', $id_peserta), $attr_peserta);
            $submit = form_submit('submit', 'Simpan', $attrsubmit);
            $data = array(
                'title' => $title,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
                'get_peserta' => $get_peserta,
                'parent' => $parent,
                'formopen' => $formopen,
                'formclose' => $formclose,
                'form' => $form,
                'label_peserta' => $label_peserta,
                'ddpeserta' => $ddpeserta,
                'inputid' => $input_id,
                'input_seminar' => $input_seminar,
                'submit' => $submit,
            );
            $this->template->load('template/template_v', 'laporan/laporan_form', $data);
        } else {
            $this->session->set_flashdata('danger', 'Data tidak ditemukan!');
            redirect('laporan');
        }
    }

    public function editaction()
    {
        $seminar = $this->input->post('seminar');
        $peserta = $this->input->post('peserta');
        $id = $this->input->post('id_presensi');
        $cek_peserta_row = $this->lp->get_presensi_row($peserta);
        if ($cek_peserta_row->num_rows() > 0) {
            $cek_peserta = $this->lp->get_presensi($peserta, $seminar);
            if ($cek_peserta->num_rows() > 0) {
                $refer =  $this->agent->referrer();
                if ($this->agent->is_referral()) {
                    $refer =  $this->agent->referrer();
                }
                $row = $cek_peserta->row();
                $nama_peserta = $row->nama_mhs;
                $this->session->set_flashdata("warning", "Peserta {$nama_peserta} sudah terdaftar!");
                redirect($refer, 'refresh');
            }
        } else {
            $cek_nim = $this->mhs->get_row($peserta);
            $nomor_induk = $cek_nim->row()->nim;
            $cek_nim = $this->mhs->get_row($peserta);
            $nomor_induk = $cek_nim->row()->nim;
            $sts_khd = 2;
            $data = array(
                'id_mahasiswa' => $peserta,
                'nomor_induk' => $nomor_induk,
                'id_seminar' => $seminar,
                'id_stskhd' => $sts_khd,
            );
            $this->lp->update_data($id, $data);
            $this->session->set_flashdata('success', 'Data Presensi berhasil diubah!');
            redirect('laporan');
        }
    }

    public function delete($id)
    {
        $this->lp->delete_data($id);
        $cek = $this->session->userdata('url');
        redirect($cek, 'refresh');
    }
}
/* End of file Laporan.php */
