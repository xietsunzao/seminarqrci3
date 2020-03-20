<?php


class Pembicara extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }        $this->load->model('Pembicara_model', 'pm');
    }

    /**
     * index.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Wednesday, December 4th, 2019.
     * @access	public
     * @return	void
     */
    public function index()
    {
        $title = 'Data Pembicara';
        $attradd = array('class' => 'btn  btn-gradient-success');
        $btnadd = anchor('pembicara/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        $get_data = $this->pm->get_data();
        $data = array(
            'pembicara' => $get_data,
            'title' => $title,
            'btntambah' => $btnadd
        );
        $this->template->load('template/template_v', 'pembicara/pembicara_v', $data);
    }

    /**
     * add.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Wednesday, December 4th, 2019.	
     * @access	public
     * @return	void
     */
    public function add()
    {
        $title = 'Tambah Pembicara';
        $parent = 'Data Pembicara';

        $attr_form = array(
            'class' => 'needs-validation',
            'novalidate' => 'novalidate'
        );

        $attr_nama = array(
            'type' => 'text',
            'name' => 'nama_pembicara',
            'class' => 'form-control',
            'value' => set_value('nama_pembicara'),
            'required' => 'required'
        );
        $attr_latarbelakang = array(
            'type' => 'text',
            'name' => 'latar_belakang',
            'class' => 'form-control',
            'value' => set_value('latar_belakang'),
            'required' => 'required'

        );
        $attr_seminar = array(
            'id' => 'seminar',
            'class' => 'form-control'
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
            'id' => 'id_pembicara',
            'value' => set_value('id_pembicara')
        );


        $attr_submit = array(
            'id' => 'submit',
            'class' => 'btn btn-gradient-info'
        );

        $get_seminar = $this->pm->get_seminar();
        $form_open = form_open_multipart('pembicara/addaction', $attr_form);
        $form_close = form_close();
        $label_nama = form_label('Nama Pembicara', 'nama_pembicara');
        $label_latarbelakang = form_label('Latar Belakang', 'latar_belakang');
        $label_seminar = form_label('Seminar', 'seminar');
        $label_foto = form_label('Foto Pembicara', 'foto');
        $input_nama = form_input($attr_nama);
        $input_id = form_input($attr_id);
        $input_latarbelakang = form_input($attr_latarbelakang);
        $invalid_nama = 'Nama pembicara harus diisi!';
        $invalid_latarbelakang = 'Latar belakang harus diisi!';

        $seminar = array();
        foreach ($get_seminar as $s) {
            $seminar[$s->id_seminar] = $s->nama_seminar;
        }
        $ddseminar = form_dropdown('seminar', $seminar, set_value('seminar'), $attr_seminar);
        $input_foto = form_input($attr_foto);
        $fe_nama = form_error('nama_pembicara');
        $fe_latarbelakang = form_error('latar_belakang');
        $submit = form_submit('Simpan', 'submit', $attr_submit);
        $data = array(
            'title' => $title,
            'parent' => $parent,
            'form_open' => $form_open,
            'form_close' => $form_close,
            'label_nama' => $label_nama,
            'label_latarbelakang' => $label_latarbelakang,
            'label_seminar' => $label_seminar,
            'label_foto' => $label_foto,
            'input_nama' => $input_nama,
            'input_latarbelakang' => $input_latarbelakang,
            'ddseminar' => $ddseminar,
            'input_foto' => $input_foto,
            'fe_nama' => $fe_nama,
            'fe_latarbelakang' => $fe_latarbelakang,
            'input_id' => $input_id,
            'submit' => $submit,
            'invalid_nama' => $invalid_nama,
            'invalid_latarbelakang' => $invalid_latarbelakang,
        );
        $this->template->load('template/template_v', 'pembicara/pembicara_form', $data);
    }

    public function update($id)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->pm->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $nama_pembicara =  $row->nama_pembicara;
            $latar_belakang = $row->latar_belakang;
            $id_pembicara = $row->id_pembicara;
            $id_seminar = $row->id_seminar;
            $foto = $row->foto;
            $title = 'Edit Pembicara';
            $parent = 'Data Pembicara';

            $attr_form = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );

            $attr_nama = array(
                'type' => 'text',
                'name' => 'nama_pembicara',
                'class' => 'form-control',
                'value' => set_value('nama_pembicara', $nama_pembicara),
                'required' => 'required'
            );
            $attr_latarbelakang = array(
                'type' => 'text',
                'name' => 'latar_belakang',
                'class' => 'form-control',
                'value' => set_value('latar_belakang', $latar_belakang),
                'required' => 'required'

            );

            $attr_seminar = array(
                'id' => 'seminar',
                'class' => 'form-control'
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
                'name' => 'id_pembicara',
                'id' => 'id_pembicara',
                'value' => set_value('id_pembicara', $id_pembicara)
            );


            $attr_submit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            $get_seminar = $this->pm->get_seminar();
            $form_open = form_open_multipart('pembicara/editaction', $attr_form);
            $form_close = form_close();
            $label_nama = form_label('Nama Pembicara', 'nama_pembicara');
            $label_latarbelakang = form_label('Latar Belakang', 'latar_belakang');
            $label_seminar = form_label('Seminar', 'seminar');
            $label_foto = form_label('Foto Pembicara', 'foto');
            $input_nama = form_input($attr_nama);
            $input_id = form_input($attr_id);
            $input_latarbelakang = form_input($attr_latarbelakang);
            $invalid_nama = 'Nama pembicara harus diisi!';
            $invalid_latarbelakang = 'Latar belakang harus diisi!';

            $seminar = array();
            foreach ($get_seminar as $s) {
                $seminar[$s->id_seminar] = $s->nama_seminar;
            }
            $ddseminar = form_dropdown('seminar', $seminar, set_value('seminar', $id_seminar), $attr_seminar);
            $input_foto = form_input($attr_foto);
            $fe_nama = form_error('nama_pembicara');
            $fe_latarbelakang = form_error('latar_belakang');
            $submit = form_submit('Simpan', 'submit', $attr_submit);
            $data = array(
                'title' => $title,
                'parent' => $parent,
                'form_open' => $form_open,
                'form_close' => $form_close,
                'label_nama' => $label_nama,
                'label_latarbelakang' => $label_latarbelakang,
                'label_seminar' => $label_seminar,
                'label_foto' => $label_foto,
                'input_nama' => $input_nama,
                'input_latarbelakang' => $input_latarbelakang,
                'ddseminar' => $ddseminar,
                'input_foto' => $input_foto,
                'fe_nama' => $fe_nama,
                'fe_latarbelakang' => $fe_latarbelakang,
                'input_id' => $input_id,
                'submit' => $submit,
                'invalid_nama' => $invalid_nama,
                'invalid_latarbelakang' => $invalid_latarbelakang,
            );
            $this->template->load('template/template_v', 'pembicara/pembicara_form', $data);
        }
    }

    public function addaction()
    {
        $this->_rules();
        $validasi = $this->form_validation->run();
        if ($validasi == FALSE) {
            $this->add();
        } else {
            $config['upload_path']   = FCPATH . '/uploads/pembicara/';
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
                $nama_pembicara = $this->input->post('nama_pembicara', TRUE);
                $latar_belakang = $this->input->post('latar_belakang', TRUE);
                $seminar = $this->input->post('seminar', TRUE);
                $foto = $this->upload->data('file_name', TRUE);
                $data = array(
                    'nama_pembicara' => $nama_pembicara,
                    'latar_belakang' => $latar_belakang,
                    'id_seminar' => $seminar,
                    'foto' => $foto,
                );
                $this->pm->insert_data($data);
                $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                redirect('pembicara');
            }
        }
    }

    public function editaction()
    {
        $id = $this->input->post('id_pembicara', TRUE);
        $nama_pembicara = $this->input->post('nama_pembicara', TRUE);
        $latar_belakang = $this->input->post('latar_belakang', TRUE);
        $seminar = $this->input->post('seminar', TRUE);
        $this->_rules();
        $validasi = $this->form_validation->run();
        if ($validasi == FALSE) {
            $this->update($id);
        } else {
            $config['upload_path']   = FCPATH . '/uploads/pembicara/';
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
                    'nama_pembicara' => $nama_pembicara,
                    'latar_belakang' => $latar_belakang,
                    'id_seminar' => $seminar,
                );
                $this->pm->update_data($id, $data);
                $this->session->set_flashdata('success', 'Data berhasil diubah!');
                redirect('pembicara');
            } else {
                $foto = $this->upload->data('file_name', TRUE);
                $get_foto = $this->pm->get_row($id)->row()->foto;
                $folder = FCPATH . '/uploads/pembicara/';
                $uploads = $folder . $get_foto;
                if (unlink($uploads)) { } else {
                    $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
                }
                $data = array(
                    'nama_pembicara' => $nama_pembicara,
                    'latar_belakang' => $latar_belakang,
                    'id_seminar' => $seminar,
                    'foto' => $foto,
                );
                $this->pm->update_data($id, $data);
                $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                redirect('pembicara');
            }
        }
    }

    public function delete($id)
    {
        $id = $this->uri->segment(3);
        $get_foto = $this->pm->get_row($id)->row()->foto;
        $folder = FCPATH . '/uploads/pembicara/';
        $uploads = $folder . $get_foto;
        if (unlink($uploads)) { } else {
            $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
        }
        $this->pm->delete_data($id);
        redirect('pembicara');
    }

    public function _rules()
    {
        $attr_nama = array(
            'required' => 'Nama seminar harus di isi!',
        );
        $attr_latarbelakang = array(
            'required' => 'Tanggal pelaksaan harus di isi!',
        );
        $this->form_validation->set_rules('nama_pembicara', 'Nama Pembicara', 'trim|required', $attr_nama);
        $this->form_validation->set_rules('latar_belakang', 'Latar Belakang', 'trim|required', $attr_latarbelakang);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
