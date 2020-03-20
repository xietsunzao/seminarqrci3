<?php


/**
 * Pendaftaran.
 *
 * @author	Jeff Maruli <jefrimaruli@gmail.com>
 * @since	v0.0.1
 * @version	v1.0.0	Wednesday, December 11th, 2019.
 * @see		CI_Controller
 * @global
 */
class Pendaftaran extends CI_Controller
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
            ]
        );
        $this->load->library('user_agent');
    }

    public function index()
    {
        $title = 'Data Pendaftaran';
        $get_seminar = $this->sm->get_data();
        $data = array(
            'title' => $title,
            'seminar' => $get_seminar,
        );
        $this->template->load('template/template_v', 'pendaftaran/pendaftaran_v', $data);
    }

    public function detail($id)
    {
        $cu = current_url();
        $url = array(
            'url' => $cu
        );
        $this->session->set_userdata($url);
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $attradd = array('class' => 'btn  btn-gradient-success');
            $tambahdata = anchor("pendaftaran/add/{$id_seminar}", "<i class='feather icon-user-plus'></i>Tambah Data", $attradd);
            $nama_seminar = $row->nama_seminar;
            $title = "Pendaftaran Seminar {$nama_seminar}";
            $peserta = $this->mhs->lihat_data();
            $pendaftaran = $this->pf->get_data($id_seminar);
            $data = array(
                'title' => $title,
                'btnadd' => $tambahdata,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
                'pendaftaran' => $pendaftaran,
                'peserta' => $peserta,
            );
            $this->template->load('template/template_v', 'pendaftaran/pendaftaran_d', $data);
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
            $title = "Tambah Data Pendaftaran";
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
                'value' => set_value('peserta'),
            );

            $attr_statusbyr = array(
                'name' => 'sts_byr',
                'id' => 'sts_byr',
                'class' => 'form-control',
            );

            $attr_metode = array(
                'name' => 'metode_pembayaran',
                'id' => 'metode_pembayaran',
                'class' => 'form-control',
            );

            $attrsubmit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            $attr_id = array(
                'type' => 'hidden',
                'name' => 'id_pendaftaran',
                'id' => 'id_pendaftaran',
                'value' => set_value('id_pendaftaran'),
            );

            $get_peserta = $this->pf->get_pst($id_seminar);
            $getStatusBayar = $this->pf->get_stsbyr();
            $getMetodeByr = $this->pf->get_metode();

            $label_peserta = form_label('Peserta', 'peserta');
            $label_statusbyr = form_label('Status Pembayaran', 'stsbyr');
            $label_metodebyr = form_label('Metode', 'mtdbyr');

            $action  = 'pendaftaran/addaction';
            $formopen = form_open($action, $attrform);
            $formclose = form_close();

            $peserta = array();
            foreach ($get_peserta as $p) {
                if ($p->id_seminar == NULL) {
                    $res = 'Belum Terdaftar';
                } else {
                    $res = "Sudah Terdaftar di seminar {$p->nama_seminar}";
                }
                $peserta[$p->id_mahasiswa] = $p->nama_mhs . " || {$p->email} ($res)";
            }

            $status_bayar = array();
            foreach ($getStatusBayar as $s) {
                $status_bayar[$s->id_stsbyr] = $s->nama_stsbyr;
            }

            $metode_bayar = array();
            foreach ($getMetodeByr as $m) {
                $metode_bayar[$m->id_metode] = $m->nama_metode;
            }

            $input_id = form_input($attr_id);
            $input_seminar = form_input($attr_seminar);


            $ddpeserta = form_dropdown('peserta', $peserta, set_value('peserta'), $attr_peserta);
            $ddstatusbyr = form_dropdown('stsbyr', $status_bayar, set_value('stsbyr'), $attr_statusbyr);
            $ddmetodebyr = form_dropdown('mtdbyr', $metode_bayar, set_value('mtdbyr'), $attr_metode);
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
                'label_statusbyr' => $label_statusbyr,
                'label_metodebyr' => $label_metodebyr,
                'ddpeserta' => $ddpeserta,
                'ddstatusbyr' => $ddstatusbyr,
                'ddmetodebyr' => $ddmetodebyr,
                'inputid' => $input_id,
                'input_seminar' => $input_seminar,
                'submit' => $submit,
            );
            $this->template->load('template/template_v', 'pendaftaran/pendaftaran_form', $data);
        } else {
            $this->session->set_flashdata('danger', 'Data tidak ditemukan!');
            redirect('pendaftaran');
        }
    }

    public function addaction()
    {

        $seminar = $this->input->post('seminar');
        $peserta = $this->input->post('peserta');
        $sts_byr = $this->input->post('stsbyr');
        $cek_peserta = $this->pf->get_peserta($peserta, $seminar);
        if ($cek_peserta->num_rows() > 0) {
            $refer =  $this->agent->referrer();
            if ($this->agent->is_referral()) {
                $refer =  $this->agent->referrer();
            }
            $row = $cek_peserta->row();
            $nama_peserta = $row->nama_mhs;
            $this->session->set_flashdata("warning", "Peserta {$nama_peserta} sudah terdaftar!");
            redirect($refer, 'refresh');
        } else {
            $tgl = date('Y-m-d');
            $jam = date('h:i:s');
            if ($sts_byr == '2') {
                $metode = 3;
            } else {
                $metode = $this->input->post('mtdbyr');
            }
            $data = array(
                'id_seminar' => $seminar,
                'id_mahasiswa' => $peserta,
                'tgl_daftar' => $tgl,
                'jam_daftar' => $jam,
                'id_stsbyr' => $sts_byr,
                'id_metode' => $metode,
            );
            $this->pf->insert_data($data);
            $this->session->set_flashdata('success', 'Data pendaftaran berhasil disimpan!');
            redirect('pendaftaran');
        }
    }

    public function update($id)
    {
        $get_row = $this->pf->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $nama_seminar = $row->nama_seminar;
            $id_peserta = $row->id_mahasiswa;
            $id_stsbyr = $row->id_stsbyr;
            $id_metode = $row->id_metode;
            $id_pendaftaran = $row->id_pendaftaran;
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

            $attr_statusbyr = array(
                'name' => 'sts_byr',
                'id' => 'sts_byr',
                'class' => 'form-control',
            );

            $attr_metode = array(
                'name' => 'metode_pembayaran',
                'id' => 'metode_pembayaran',
                'class' => 'form-control',
            );

            $attrsubmit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            $attr_id = array(
                'type' => 'hidden',
                'name' => 'id_pendaftaran',
                'id' => 'id_pendaftaran',
                'value' => set_value('id_pendaftaran', $id_pendaftaran),
            );

            $get_peserta = $this->pf->get_pst();
            $getStatusBayar = $this->pf->get_stsbyr();
            $getMetodeByr = $this->pf->get_metode();

            $label_peserta = form_label('Peserta', 'peserta');
            $label_statusbyr = form_label('Status Pembayaran', 'stsbyr');
            $label_metodebyr = form_label('Metode', 'mtdbyr');

            $action  = 'pendaftaran/editaction';
            $formopen = form_open($action, $attrform);
            $formclose = form_close();

            $peserta = array();
            foreach ($get_peserta as $p) {
                if ($p->id_seminar == NULL) {
                    $res = 'Belum Terdaftar';
                } else {
                    $res = 'Sudah Terdaftar';
                }
                $peserta[$p->id_mahasiswa] = $p->nama_mhs . " || {$p->email} ($res)";
            }

            $status_bayar = array();
            foreach ($getStatusBayar as $s) {
                $status_bayar[$s->id_stsbyr] = $s->nama_stsbyr;
            }

            $metode_bayar = array();
            foreach ($getMetodeByr as $m) {
                $metode_bayar[$m->id_metode] = $m->nama_metode;
            }

            $input_id = form_input($attr_id);
            $input_seminar = form_input($attr_seminar);


            $ddpeserta = form_dropdown('peserta', $peserta, set_value('peserta', $id_peserta), $attr_peserta);
            $ddstatusbyr = form_dropdown('stsbyr', $status_bayar, set_value('stsbyr', $id_stsbyr), $attr_statusbyr);
            $ddmetodebyr = form_dropdown('mtdbyr', $metode_bayar, set_value('mtdbyr', $id_metode), $attr_metode);
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
                'label_statusbyr' => $label_statusbyr,
                'label_metodebyr' => $label_metodebyr,
                'ddpeserta' => $ddpeserta,
                'ddstatusbyr' => $ddstatusbyr,
                'ddmetodebyr' => $ddmetodebyr,
                'inputid' => $input_id,
                'input_seminar' => $input_seminar,
                'submit' => $submit,
            );
            $this->template->load('template/template_v', 'pendaftaran/pendaftaran_form', $data);
        } else {
            $this->session->set_flashdata('danger', 'Data tidak ditemukan!');
            redirect('pendaftaran');
        }
    }

    public function editaction()
    {
        $seminar = $this->input->post('seminar');
        $peserta = $this->input->post('peserta');
        $sts_byr = $this->input->post('stsbyr');
        $id = $this->input->post('id_pendaftaran');
        $cek_peserta_row = $this->pf->get_peserta_row($id, $peserta);
        if ($cek_peserta_row->num_rows() == 0) {
            $cek_peserta = $this->pf->get_peserta($peserta, $seminar);
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
            if ($sts_byr == '2') {
                $metode = 3;
            } else {
                $metode = $this->input->post('mtdbyr');
            }
            $data = array(
                'id_seminar' => $seminar,
                'id_mahasiswa' => $peserta,
                'id_stsbyr' => $sts_byr,
                'id_metode' => $metode,
            );
            $this->pf->update_data($id, $data);
            $this->session->set_flashdata('success', 'Data pendaftaran berhasil diubah!');
            redirect('pendaftaran');
        }
    }

    public function delete($id)
    {
        $this->pf->delete_data($id);
        $cek = $this->session->userdata('url');
        redirect($cek, 'refresh');
    }
}
