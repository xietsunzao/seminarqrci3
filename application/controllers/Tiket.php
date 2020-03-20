<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Tiket
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

class Tiket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }        $this->load->model('Tiket_model', 'tkt');
    }

    public function index()
    {
        $title = 'Data Tiket';
        $attradd = array('class' => 'btn  btn-gradient-success');
        $tambahdata = anchor('tiket/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        $tiket = $this->tkt->get_data();
        $data = array(
            'tiket' => $tiket,
            'title' => $title,
            'btntambah' => $tambahdata,
        );
        $this->template->load('template/template_v', 'tiket/tiket_v', $data);
    }

    public function add()
    {
        $title = 'Tambah tiket';
        $parent = 'Data tiket';

        $attr_form = array(
            'class' => 'needs-validation',
            'novalidate' => 'novalidate'
        );

        $attr_seminar = array(
            'id' => 'seminar',
            'class' => 'form-control'
        );

        $attr_harga = array(
            'type' => 'text',
            'name' => 'harga_tiket',
            'id' => 'rupiah',
            'class' => 'form-control',
            'value' => set_value('harga_tiket')
        );

        $attr_slot = array(
            'type' => 'text',
            'name' => 'slot_tiket',
            'id' => 'slot_tiket',
            'class' => 'form-control slot',
            'value' => set_value('slot_tiket')
        );

        $attr_foto = array(
            'type' => 'file',
            'name' => 'foto',
            'value' => set_value('foto'),
            'placeholder' => 'foto',
            'id' => 'input-file-now',
            'class' => 'dropify',
        );

        $attr_id = array(
            'type' => 'hidden',
            'id' => 'id_tiket',
            'value' => set_value('id_tiket')
        );

        $attr_submit = array(
            'id' => 'submit',
            'class' => 'btn btn-gradient-info'
        );

        $get_seminar = $this->tkt->get_seminar();
        $form_open = form_open_multipart('tiket/addaction', $attr_form);
        $form_close = form_close();
        $label_nama = form_label('Nama Tiket', 'nama_tiket');
        $label_seminar = form_label('Seminar', 'seminar');
        $label_harga =  form_label('Harga Tiket', 'harga_tiket');
        $label_slot = form_label('Slot Tiket', 'slot_tiket');
        $label_foto = form_label('Foto Tiket', 'foto');
        $input_harga = form_input($attr_harga);
        $input_slot = form_input($attr_slot);


        $input_id = form_input($attr_id);
        $invalid_nama = 'Nama tiket harus diisi!';

        $seminar = array();
        foreach ($get_seminar as $s) {
            $seminar[$s->id_seminar] = $s->nama_seminar;
        }
        $ddseminar = form_dropdown('seminar', $seminar, set_value('seminar'), $attr_seminar);
        $input_foto = form_input($attr_foto);
        $fe_harga = form_error('harga_tiket');
        $fe_slot = form_error('slot_tiket');
        $submit = form_submit('Simpan', 'submit', $attr_submit);
        $data = array(
            'title' => $title,
            'parent' => $parent,
            'form_open' => $form_open,
            'form_close' => $form_close,
            'label_nama' => $label_nama,
            'label_seminar' => $label_seminar,
            'label_harga' => $label_harga,
            'label_slot' => $label_slot,
            'label_foto' => $label_foto,
            'ddseminar' => $ddseminar,
            'input_harga' => $input_harga,
            'input_slot' => $input_slot,
            'input_foto' => $input_foto,
            'fe_harga' => $fe_harga,
            'fe_slot' => $fe_slot,
            'input_id' => $input_id,
            'submit' => $submit,
            'invalid_nama' => $invalid_nama,
        );
        $this->template->load('template/template_v', 'tiket/tiket_form', $data);
    }

    public function addaction()
    {
        $seminar = $this->input->post('seminar', TRUE);
        $cek_seminar = $this->tkt->cek_seminar($seminar);
        if ($cek_seminar->num_rows() > 0) {
            $nama_seminar = $cek_seminar->row()->nama_seminar;
            $this->session->set_flashdata("warning", "Data seminar {$nama_seminar} sudah ada !");
            redirect('tiket');
        } else {
            $this->_rules();
            $validasi = $this->form_validation->run();
            if ($validasi == FALSE) {
                $this->add();
            } else {
                $config['upload_path']   = FCPATH . '/uploads/tiket/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']  = '1000';
                $config['max_width']  = '5000';
                $config['max_height']  = '5000';
                $config['overwrite'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('warning', $this->upload->display_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $harga_tiket = $this->input->post('harga_tiket', TRUE);
                    $slot_tiket = $this->input->post('slot_tiket', TRUE);
                    $foto = $this->upload->data('file_name', TRUE);
                    $hrg_tkt = str_replace(['.', 'Rp'], '', $harga_tiket);
                    $data = array(
                        'id_seminar' => $seminar,
                        'harga_tiket' => $hrg_tkt,
                        'slot_tiket' => $slot_tiket,
                        'lampiran_tiket' => $foto,
                    );
                    $this->tkt->insert_data($data);
                    $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                    redirect('tiket');
                }
            }
        }
    }

    public function update($id)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->tkt->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_tiket = $row->id_tiket;
            $id_seminar = $row->id_seminar;
            $harga_tiket = $row->harga_tiket;
            $slot_tiket = $row->slot_tiket;
            $foto = $row->lampiran_tiket;
            $title = 'Edit tiket';
            $parent = 'Data tiket';

            $attr_form = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );


            $attr_seminar = array(
                'id' => 'seminar',
                'class' => 'form-control'
            );

            $attr_harga = array(
                'type' => 'text',
                'name' => 'harga_tiket',
                'id' => 'rupiah',
                'class' => 'form-control',
                'value' => set_value('harga_tiket', $harga_tiket)
            );

            $attr_slot = array(
                'type' => 'text',
                'name' => 'slot_tiket',
                'id' => 'slot_tiket',
                'class' => 'form-control slot',
                'value' => set_value('slot_tiket', $slot_tiket)
            );

            $attr_foto = array(
                'type' => 'file',
                'name' => 'foto',
                'value' => set_value('lampiran'),
                'placeholder' => 'Lampiran',
                'id' => 'input-file-now',
                'class' => 'dropify',
            );

            $attr_id = array(
                'type' => 'hidden',
                'name' => 'id_tiket',
                'id' => 'id_tiket',
                'value' => set_value('id_tiket', $id_tiket)
            );

            $attr_submit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            $get_seminar = $this->tkt->get_seminar();
            $form_open = form_open_multipart('tiket/editaction', $attr_form);
            $form_close = form_close();
            $label_nama = form_label('Nama tiket', 'nama_tiket');
            $label_seminar = form_label('Seminar', 'seminar');
            $label_foto = form_label('Foto tiket', 'foto');
            $label_harga =  form_label('Harga Tiket', 'harga_tiket');
            $label_slot = form_label('Slot Tiket', 'slot_tiket');
            $input_harga = form_input($attr_harga);
            $input_slot = form_input($attr_slot);
            $input_id = form_input($attr_id);
            $invalid_nama = 'Nama tiket harus diisi!';
            $fe_harga = form_error('harga_tiket');
            $fe_slot = form_error('slot_tiket');

            $seminar = array();
            foreach ($get_seminar as $s) {
                $seminar[$s->id_seminar] = $s->nama_seminar;
            }
            $ddseminar = form_dropdown('seminar', $seminar, set_value('seminar', $id_seminar), $attr_seminar);
            $input_foto = form_input($attr_foto);
            $submit = form_submit('Simpan', 'submit', $attr_submit);
            $data = array(
                'title' => $title,
                'parent' => $parent,
                'form_open' => $form_open,
                'form_close' => $form_close,
                'label_nama' => $label_nama,
                'label_seminar' => $label_seminar,
                'label_harga' => $label_harga,
                'label_slot' => $label_slot,
                'label_foto' => $label_foto,
                'ddseminar' => $ddseminar,
                'input_foto' => $input_foto,
                'input_harga' => $input_harga,
                'input_slot' => $input_slot,
                'input_id' => $input_id,
                'fe_harga' => $fe_harga,
                'fe_slot' => $fe_slot,
                'submit' => $submit,
                'invalid_nama' => $invalid_nama,
            );
            $this->template->load('template/template_v', 'tiket/tiket_form', $data);
        }
    }

    public function editaction()
    {
        $seminar = $this->input->post('seminar', TRUE);
        $cek_seminar = $this->tkt->cek_seminar_edit($seminar);
        if ($cek_seminar->num_rows() > 0) {
            $nama_seminar = $cek_seminar->row()->nama_seminar;
            $this->session->set_flashdata("warning", "Data seminar {$nama_seminar} sudah ada !");
            redirect('tiket');
        } else {
            $id = $this->input->post('id_tiket', TRUE);
            $harga_tiket = $this->input->post('harga_tiket', TRUE);
            $hrg_tkt = str_replace(['.', 'Rp'], '', $harga_tiket);
            $slot_tiket = $this->input->post('slot_tiket', TRUE);
            $this->_rules();
            $validasi = $this->form_validation->run();
            if ($validasi == FALSE) {
                $this->update($id);
            } else {
                $config['upload_path']   = FCPATH . '/uploads/tiket/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']  = '1000';
                $config['max_width']  = '5000';
                $config['max_height']  = '5000';
                $config['overwrite'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('foto')) {
                    $data = array(
                        'id_seminar' => $seminar,
                        'harga_tiket' => $hrg_tkt,
                        'slot_tiket' => $slot_tiket,
                    );
                    $this->tkt->update_data($id, $data);
                    $this->session->set_flashdata('success', 'Data berhasil diubah!');
                    redirect('tiket');
                } else {
                    $foto = $this->upload->data('file_name', TRUE);
                    $get_foto = $this->tkt->get_row($id)->row()->lampiran_tiket;
                    $folder = FCPATH . '/uploads/tiket/';
                    $uploads = $folder . $get_foto;
                    if (unlink($uploads)) { } else {
                        $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
                    }
                    $data = array(
                        'id_seminar' => $seminar,
                        'harga_tiket' => $hrg_tkt,
                        'slot_tiket' => $slot_tiket,
                        'lampiran_tiket' => $foto,
                    );
                    $this->tkt->update_data($id, $data);
                    $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                    redirect('tiket');
                }
            }
        }
    }

    public function delete($id)
    {
        $id = $this->uri->segment(3);
        $get_foto = $this->tkt->get_row($id)->row()->lampiran_tiket;
        $folder = FCPATH . '/uploads/tiket/';
        $uploads = $folder . $get_foto;
        if (unlink($uploads)) { } else {
            $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
        }
        $this->tkt->delete_data($id);
        redirect('tiket');
    }

    public function _rules()
    {

        $attr_harga = array(
            'required' => 'Harga tiket harus di isi!'
        );

        $attr_slot = array(
            'required' => 'Slot tiket harus di isi!'
        );
        $this->form_validation->set_rules('harga_tiket', 'Harga tiket', 'trim|required', $attr_harga);
        $this->form_validation->set_rules('slot_tiket', 'Slot tiket', 'trim|required', $attr_slot);

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}


/* End of file Tiket.php */
/* Location: ./application/controllers/Tiket.php */
